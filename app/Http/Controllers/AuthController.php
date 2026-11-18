<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

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
        MaterialController::asegurarMaterialesIniciales();

        $usuario = Auth::user();
        $hashAlmacenado = '';
        if ($usuario) {
            $hashAlmacenado = (string) DB::table('usuarios')->where('id', $usuario->id)->value('password');
        }

        $materiales = collect();
        try {
            $materiales = Material::where('disponible', true)->orderBy('id', 'asc')->take(4)->get();
        } catch (\Throwable $e) {
            // Si la BD no responde, la vista usará valores por defecto
        }

        $modoInicial = session('auth_modo')
            ?? ($request->query('modo') === 'registro' ? 'registro' : ($request->query('modo') === 'recuperar' ? 'recuperar' : 'login'));
        $mostrarModal = $request->is('login')
            || $request->has('modo')
            || session()->has('errors')
            || session()->has('auth_exito')
            || session('auth_modo') === 'recuperar';

        if ($modoInicial !== 'recuperar') {
            $request->session()->forget([
                'rec_usuario_id', 'rec_codigo', 'rec_codigo_demo',
                'rec_destino', 'rec_expira', 'rec_verificado',
            ]);
        }

        $pasoRecuperar = session('rec_verificado') ? 3 : (session('rec_codigo') ? 2 : 1);

        return view('auth.login', [
            'usuario' => $usuario,
            'hashAlmacenado' => $hashAlmacenado,
            'materiales' => $materiales,
            'modoInicial' => $modoInicial,
            'mostrarModal' => $mostrarModal,
            'pasoRecuperar' => $pasoRecuperar,
            'recDestino' => session('rec_destino', ''),
            'recCodigoDemo' => session('rec_codigo_demo', ''),
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
            return redirect()->intended(route('inventario.index'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Las credenciales ingresadas no coinciden con nuestros registros.',
            ]);
    }

    /**
     * Genera un CAPTCHA visual en formato SVG y guarda el código en la sesión del servidor.
     */
    public function captcha(Request $request)
    {
        $caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $codigo = '';
        for ($i = 0; $i < 5; $i++) {
            $codigo .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        $request->session()->put('captcha_code', $codigo);

        $lineas = '';
        $coloresLineas = ['#cbd5e1', '#93c5fd', '#a5b4fc', '#94a3b8'];
        for ($i = 0; $i < 6; $i++) {
            $x1 = random_int(0, 160);
            $y1 = random_int(0, 52);
            $x2 = random_int(0, 160);
            $y2 = random_int(0, 52);
            $color = $coloresLineas[array_rand($coloresLineas)];
            $lineas .= "<line x1=\"{$x1}\" y1=\"{$y1}\" x2=\"{$x2}\" y2=\"{$y2}\" stroke=\"{$color}\" stroke-width=\"1.4\" opacity=\"0.7\"/>";
        }

        $letrasSvg = '';
        $coloresTexto = ['#1e3a8a', '#3154ce', '#0f172a', '#1d4ed8'];
        for ($i = 0; $i < strlen($codigo); $i++) {
            $x = 18 + ($i * 28);
            $y = random_int(30, 38);
            $angulo = random_int(-18, 18);
            $color = $coloresTexto[array_rand($coloresTexto)];
            $char = htmlspecialchars($codigo[$i], ENT_XML1, 'UTF-8');
            $letrasSvg .= "<text x=\"{$x}\" y=\"{$y}\" fill=\"{$color}\" font-family=\"Inter, Arial, sans-serif\" font-size=\"24\" font-weight=\"800\" transform=\"rotate({$angulo} {$x} {$y})\">{$char}</text>";
        }

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="160" height="52" viewBox="0 0 160 52">
  <rect width="160" height="52" rx="10" fill="#f1f5f9"/>
  {$lineas}
  {$letrasSvg}
</svg>
SVG;

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        ]);
    }

    /**
     * Procesa el registro de una nueva cuenta cifrando la contraseña con Bcrypt (12 rondas).
     */
    public function register(Request $request)
    {
        $request->session()->flash('auth_modo', 'registro');

        $datos = $request->validate([
            'nombre_completo' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:100', 'unique:usuarios,email'],
            'telefono' => ['required', 'string', 'max:20', 'unique:usuarios,telefono'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers()->symbols(),
            ],
            'captcha' => ['required', 'string'],
        ], [
            'nombre_completo.required' => 'Ingresa tus nombres y apellidos.',
            'email.unique' => 'Este correo electrónico ya está registrado en CALJIM.',
            'telefono.unique' => 'Este número de teléfono ya está registrado en CALJIM.',
            'password.confirmed' => 'Las dos contraseñas no coinciden. Verifícalas e inténtalo de nuevo.',
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',
            'password.letters' => 'La contraseña debe incluir al menos una letra.',
            'password.numbers' => 'La contraseña debe incluir al menos un número.',
            'password.symbols' => 'La contraseña debe incluir al menos un carácter especial (ej. @, #, $, *, !).',
            'captcha.required' => 'Ingresa el código de seguridad (CAPTCHA).',
        ]);

        $captchaEsperado = (string) $request->session()->pull('captcha_code', '');
        if ($captchaEsperado === '' || strtoupper(trim($datos['captcha'])) !== strtoupper($captchaEsperado)) {
            return back()
                ->withInput($request->except('password', 'password_confirmation', 'captcha'))
                ->withErrors([
                    'captcha' => 'El código CAPTCHA es incorrecto. Inténtalo de nuevo.',
                ]);
        }

        $usuario = Usuario::create([
            'nombre_completo' => $datos['nombre_completo'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'rol' => 'cliente',
            'cedula_ruc' => '9999999999',
            'telefono' => $datos['telefono'],
            'direccion' => 'Paquisha, Ecuador',
            'estado' => true,
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->route('inventario.index');
    }

    /**
     * Paso 1 de recuperación: verifica correo o celular y genera un código OTP de 6 dígitos.
     */
    public function sendResetCode(Request $request)
    {
        $request->session()->flash('auth_modo', 'recuperar');

        $datos = $request->validate([
            'metodo' => ['required', 'in:email,telefono'],
            'email' => ['required_if:metodo,email', 'nullable', 'email'],
            'telefono' => ['required_if:metodo,telefono', 'nullable', 'string', 'max:20'],
        ], [
            'email.required_if' => 'Ingresa tu correo electrónico registrado.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'telefono.required_if' => 'Ingresa tu número de celular registrado.',
        ]);

        if ($datos['metodo'] === 'telefono') {
            $valor = trim((string) $datos['telefono']);
            $usuario = Usuario::where('telefono', $valor)->where('estado', 1)->first();
        } else {
            $valor = trim((string) $datos['email']);
            $usuario = Usuario::where('email', $valor)->where('estado', 1)->first();
        }

        if (!$usuario) {
            $msg = $datos['metodo'] === 'telefono'
                ? 'No se encontró ninguna cuenta activa con ese número de celular.'
                : 'No se encontró ninguna cuenta activa con ese correo electrónico.';

            return back()
                ->withInput($request->only('metodo', 'email', 'telefono'))
                ->withErrors(['email' => $msg]);
        }

        $codigo = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $request->session()->put([
            'rec_usuario_id' => $usuario->id,
            'rec_codigo' => Hash::make($codigo),
            'rec_codigo_demo' => $codigo,
            'rec_destino' => $valor,
            'rec_expira' => now()->addMinutes(10)->timestamp,
            'rec_verificado' => false,
        ]);

        Log::info("Código de recuperación CALJIM para {$valor}: {$codigo}");

        return redirect()->route('inicio')->with('auth_modo', 'recuperar');
    }

    /**
     * Paso 2 de recuperación: valida el código de 6 dígitos ingresado por el usuario.
     */
    public function verifyResetCode(Request $request)
    {
        $request->session()->flash('auth_modo', 'recuperar');

        $datos = $request->validate([
            'codigo' => ['required', 'digits:6'],
        ], [
            'codigo.required' => 'Ingresa el código de verificación de 6 dígitos.',
            'codigo.digits' => 'El código de verificación debe tener exactamente 6 dígitos.',
        ]);

        $hashCodigo = (string) $request->session()->get('rec_codigo', '');
        $expira = (int) $request->session()->get('rec_expira', 0);

        if ($hashCodigo === '' || now()->timestamp > $expira) {
            $request->session()->forget(['rec_usuario_id', 'rec_codigo', 'rec_codigo_demo', 'rec_destino', 'rec_expira', 'rec_verificado']);
            return back()->withErrors([
                'codigo' => 'El código de verificación expiró. Solicita uno nuevo.',
            ]);
        }

        if (!Hash::check(trim($datos['codigo']), $hashCodigo)) {
            return back()->withErrors([
                'codigo' => 'El código de verificación es incorrecto. Verifícalo e inténtalo de nuevo.',
            ]);
        }

        $request->session()->put('rec_verificado', true);
        $request->session()->forget('rec_codigo_demo');

        return redirect()->route('inicio')->with('auth_modo', 'recuperar');
    }

    /**
     * Paso 3 de recuperación: guarda la nueva contraseña cifrada con Bcrypt.
     */
    public function resetPassword(Request $request)
    {
        $request->session()->flash('auth_modo', 'recuperar');

        if (!$request->session()->get('rec_verificado') || !$request->session()->get('rec_usuario_id')) {
            return redirect()->route('password.restart')
                ->withErrors(['codigo' => 'Debes verificar primero tu código de seguridad.']);
        }

        $datos = $request->validate([
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers()->symbols(),
            ],
        ], [
            'password.confirmed' => 'Las dos contraseñas no coinciden.',
            'password.min' => 'La nueva contraseña debe tener mínimo 8 caracteres.',
            'password.letters' => 'La nueva contraseña debe incluir al menos una letra.',
            'password.numbers' => 'La nueva contraseña debe incluir al menos un número.',
            'password.symbols' => 'La nueva contraseña debe incluir al menos un carácter especial (ej. @, #, $, *, !).',
        ]);

        $usuario = Usuario::find($request->session()->get('rec_usuario_id'));
        if ($usuario) {
            $usuario->update([
                'password' => Hash::make($datos['password']),
            ]);
        }

        $request->session()->forget(['rec_usuario_id', 'rec_codigo', 'rec_codigo_demo', 'rec_destino', 'rec_expira', 'rec_verificado']);

        return redirect()->route('login')
            ->with('auth_exito', '¡Contraseña actualizada con éxito! Ya puedes iniciar sesión con tu nueva clave.');
    }

    /**
     * Reinicia el flujo de recuperación al Paso 1.
     */
    public function restartReset(Request $request)
    {
        $request->session()->forget(['rec_usuario_id', 'rec_codigo', 'rec_codigo_demo', 'rec_destino', 'rec_expira', 'rec_verificado']);
        if ($request->query('ajax') === '1') {
            return response()->json(['ok' => true]);
        }
        return redirect()->route('inicio')->with('auth_modo', 'recuperar');
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
            return redirect()->route('inventario.index');
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
