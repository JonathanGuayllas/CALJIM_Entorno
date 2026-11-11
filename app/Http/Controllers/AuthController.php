<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Asegura que existan las 4 cuentas de demostración con contraseñas cifradas (Bcrypt).
     */
    private function asegurarUsuariosDemo(): void
    {
        try {
            $demos = [
                [
                    'email' => 'admin1@caljim.com',
                    'nombre_completo' => 'Jonathan Guayllas (Admin · Perfil 1)',
                    'rol' => 'admin',
                    'cedula_ruc' => '1900112233001',
                    'telefono' => '0987654321',
                    'direccion' => 'Paquisha, Zamora Chinchipe',
                ],
                [
                    'email' => 'admin2@caljim.com',
                    'nombre_completo' => 'Fabian Cañar (Admin · Perfil 2)',
                    'rol' => 'admin',
                    'cedula_ruc' => '1900223344001',
                    'telefono' => '0987654322',
                    'direccion' => 'Paquisha, Zamora Chinchipe',
                ],
                [
                    'email' => 'trabajador@caljim.com',
                    'nombre_completo' => 'Alfonso Ocampo (Operario / Conductor)',
                    'rol' => 'operario',
                    'cedula_ruc' => '1900334455',
                    'telefono' => '0987654323',
                    'direccion' => 'Paquisha, Zamora Chinchipe',
                    'licencia_conducir' => 'Tipo E - Profesional',
                    'tarifa_hora' => 8.50,
                ],
                [
                    'email' => 'cliente@caljim.com',
                    'nombre_completo' => 'Constructora Del Sur S.A.',
                    'rol' => 'cliente',
                    'cedula_ruc' => '1191234567001',
                    'telefono' => '0991122334',
                    'direccion' => 'Av. Principal, Zamora',
                ],
            ];

            foreach ($demos as $demo) {
                Usuario::firstOrCreate(
                    ['email' => $demo['email']],
                    array_merge($demo, [
                        'password' => Hash::make('Caljim2026*'),
                        'estado' => true,
                    ])
                );
            }
        } catch (\Throwable $e) {
            // Si la BD aún no está disponible, no interrumpir la carga visual
        }
    }

    /**
     * Muestra 1. Pantalla Principal (Figma 53:355) con el modal de Logueo / Crear Cuenta (58:1112 y 58:1244).
     */
    public function showLogin(Request $request)
    {
        $this->asegurarUsuariosDemo();

        $usuario = Auth::user();
        $hashAlmacenado = '';
        if ($usuario) {
            $hashAlmacenado = (string) DB::table('usuarios')->where('id', $usuario->id)->value('password');
        }

        $modoInicial = $request->query('modo') === 'registro' ? 'registro' : 'login';
        $mostrarModal = $request->is('login')
            || $request->has('modo')
            || session()->has('errors');

        return view('auth.login', [
            'usuario' => $usuario,
            'hashAlmacenado' => $hashAlmacenado,
            'modoInicial' => $modoInicial,
            'mostrarModal' => $mostrarModal,
        ]);
    }

    /**
     * Procesa el inicio de sesión verificando hash Bcrypt y protegiendo contra fijación de sesión.
     */
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Ingresa tu correo electrónico.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'password.required' => 'Ingresa tu contraseña.',
        ]);

        if (Auth::attempt([
            'email' => $credenciales['email'],
            'password' => $credenciales['password'],
            'estado' => 1,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('inicio');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Las credenciales ingresadas no coinciden con nuestros registros.',
            ]);
    }

    /**
     * Procesa el registro de una nueva cuenta cifrando la contraseña con Bcrypt (12 rondas).
     */
    public function register(Request $request)
    {
        $datos = $request->validate([
            'nombre_completo' => ['required', 'string', 'max:120'],
            'rol' => ['required', 'in:cliente,operario,admin'],
            'email' => ['required', 'email', 'max:100', 'unique:usuarios,email'],
            'telefono' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'nombre_completo.required' => 'Ingresa tus nombres y apellidos.',
            'email.unique' => 'Este correo electrónico ya está registrado en CALJIM.',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
        ]);

        $usuario = Usuario::create([
            'nombre_completo' => $datos['nombre_completo'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'rol' => $datos['rol'],
            'cedula_ruc' => '9999999999',
            'telefono' => $datos['telefono'],
            'direccion' => 'Paquisha, Ecuador',
            'estado' => true,
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->route('inicio');
    }

    /**
     * Acceso rápido para los 4 botones de "Vistas de Demostración" del diseño Figma.
     */
    public function demoLogin(Request $request, string $perfil)
    {
        $this->asegurarUsuariosDemo();

        $mapaCorreos = [
            'admin1' => 'admin1@caljim.com',
            'admin2' => 'admin2@caljim.com',
            'trabajador' => 'trabajador@caljim.com',
            'cliente' => 'cliente@caljim.com',
        ];

        $email = $mapaCorreos[$perfil] ?? 'cliente@caljim.com';
        $usuario = Usuario::where('email', $email)->first();

        if ($usuario) {
            Auth::login($usuario);
            $request->session()->regenerate();
        }

        return redirect()->route('inicio');
    }

    /**
     * Cierra la sesión e invalida el token CSRF.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}
