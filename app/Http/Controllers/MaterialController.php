<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Si la tabla materiales está vacía, carga los 6 materiales oficiales del diseño Figma.
     */
    public static function asegurarMaterialesIniciales(): void
    {
        try {
            if (Material::count() === 0) {
                $iniciales = [
                    [
                        'codigo' => 'MAT-01',
                        'nombre' => 'Arena de río',
                        'descripcion' => 'Arena lavada natural ideal para hormigón, morteros y acabados.',
                        'precio_m3' => 18.00,
                        'stock_m3' => 86.00,
                        'stock_minimo_m3' => 15.00,
                        'disponible' => true,
                    ],
                    [
                        'codigo' => 'MAT-02',
                        'nombre' => 'Lastre',
                        'descripcion' => 'Material granular resistente para relleno, nivelación y vías.',
                        'precio_m3' => 16.00,
                        'stock_m3' => 142.00,
                        'stock_minimo_m3' => 20.00,
                        'disponible' => true,
                    ],
                    [
                        'codigo' => 'MAT-03',
                        'nombre' => 'Ripio',
                        'descripcion' => 'Árido triturado seleccionado para mezclas estructurales y losas.',
                        'precio_m3' => 19.00,
                        'stock_m3' => 72.00,
                        'stock_minimo_m3' => 15.00,
                        'disponible' => true,
                    ],
                    [
                        'codigo' => 'MAT-04',
                        'nombre' => 'Piedra bola',
                        'descripcion' => 'Piedra de río para cimentaciones, drenajes y gaviones.',
                        'precio_m3' => 22.00,
                        'stock_m3' => 55.00,
                        'stock_minimo_m3' => 10.00,
                        'disponible' => true,
                    ],
                    [
                        'codigo' => 'MAT-05',
                        'nombre' => 'Base granular',
                        'descripcion' => 'Material clasificado de alta compactación para capa de rodadura.',
                        'precio_m3' => 21.00,
                        'stock_m3' => 93.00,
                        'stock_minimo_m3' => 15.00,
                        'disponible' => true,
                    ],
                    [
                        'codigo' => 'MAT-06',
                        'nombre' => 'Subbase',
                        'descripcion' => 'Material de soporte estructural para vías y plataformas.',
                        'precio_m3' => 17.00,
                        'stock_m3' => 68.00,
                        'stock_minimo_m3' => 15.00,
                        'disponible' => true,
                    ],
                ];

                foreach ($iniciales as $item) {
                    Material::create($item);
                }
            }
        } catch (\Throwable $e) {
            // No interrumpir si hay un fallo temporal de conexión
        }
    }

    /**
     * Muestra el Panel de Inventario (RF-01, RF-02) adaptado al rol del usuario (RBAC).
     */
    public function index(Request $request)
    {
        self::asegurarMaterialesIniciales();

        $buscar = trim((string) $request->query('buscar', ''));

        $consulta = Material::query()->orderBy('id', 'asc');
        if ($buscar !== '') {
            $consulta->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('codigo', 'like', "%{$buscar}%");
            });
        }

        $materiales = $consulta->get();
        $usuario = Auth::user();

        return view('inventario.index', [
            'usuario' => $usuario,
            'materiales' => $materiales,
            'buscar' => $buscar,
            'esAdmin' => $usuario->rol === 'admin',
        ]);
    }

    /**
     * Registra un nuevo material árido en la base de datos (Solo Administrador - RF-01).
     */
    public function store(Request $request)
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403, 'Acceso denegado: solo el Administrador puede agregar materiales.');
        }

        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:20', 'unique:materiales,codigo'],
            'nombre' => ['required', 'string', 'max:100'],
            'stock_m3' => ['required', 'numeric', 'min:0'],
            'precio_m3' => ['required', 'numeric', 'min:0.01'],
            'stock_minimo_m3' => ['nullable', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ], [
            'codigo.required' => 'Ingresa el código del material.',
            'codigo.unique' => 'Ya existe un material con ese código.',
            'nombre.required' => 'Ingresa el nombre del material.',
            'stock_m3.min' => 'La existencia no puede ser negativa.',
            'precio_m3.min' => 'El precio debe ser mayor a $0.00.',
        ]);

        Material::create([
            'codigo' => strtoupper(trim($datos['codigo'])),
            'nombre' => trim($datos['nombre']),
            'stock_m3' => $datos['stock_m3'],
            'precio_m3' => $datos['precio_m3'],
            'stock_minimo_m3' => $datos['stock_minimo_m3'] ?? 10.00,
            'descripcion' => $datos['descripcion'] ?? null,
            'disponible' => $request->boolean('disponible', true),
        ]);

        return redirect()->route('inventario.index')
            ->with('exito', 'Material "' . $datos['nombre'] . '" registrado correctamente en el inventario.');
    }

    /**
     * Actualiza el stock, precio o disponibilidad de un material existente (Solo Administrador - RF-01).
     */
    public function update(Request $request, Material $material)
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403, 'Acceso denegado: solo el Administrador puede editar el inventario.');
        }

        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:20', 'unique:materiales,codigo,' . $material->id],
            'nombre' => ['required', 'string', 'max:100'],
            'stock_m3' => ['required', 'numeric', 'min:0'],
            'precio_m3' => ['required', 'numeric', 'min:0.01'],
            'stock_minimo_m3' => ['nullable', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ], [
            'codigo.unique' => 'Ya existe otro material con ese código.',
            'nombre.required' => 'El nombre del material es obligatorio.',
        ]);

        $material->update([
            'codigo' => strtoupper(trim($datos['codigo'])),
            'nombre' => trim($datos['nombre']),
            'stock_m3' => $datos['stock_m3'],
            'precio_m3' => $datos['precio_m3'],
            'stock_minimo_m3' => $datos['stock_minimo_m3'] ?? $material->stock_minimo_m3,
            'descripcion' => $datos['descripcion'] ?? null,
            'disponible' => $request->has('disponible'),
        ]);

        return redirect()->route('inventario.index')
            ->with('exito', 'Material "' . $material->nombre . '" actualizado correctamente.');
    }

    /**
     * Elimina un material del inventario (Solo Administrador - RF-01).
     */
    public function destroy(Material $material)
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403, 'Acceso denegado: solo el Administrador puede dar de baja materiales.');
        }

        $nombre = $material->nombre;
        $material->delete();

        return redirect()->route('inventario.index')
            ->with('exito', 'Material "' . $nombre . '" eliminado del inventario.');
    }
}

