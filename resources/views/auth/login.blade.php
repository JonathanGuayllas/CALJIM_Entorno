<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALJIM — Material pétreo, transporte y maquinaria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ filemtime(public_path('css/estilos.css')) }}">
</head>
<body>

    <!-- ==================================================================
         HEADER / NAVBAR (Figma Node 53:662)
         ================================================================== -->
    <header class="site-header" data-node-id="53:662">
        <div class="header-container" data-node-id="53:663">
            <a href="#inicio" class="brand-link" data-node-id="53:664">
                <div class="brand-logo-wrap" data-node-id="53:665">
                    <img src="{{ asset('img/logo-caljim-header.png') }}" alt="CALJIM" class="brand-logo-img">
                </div>
                <div class="brand-tagline-box" data-node-id="53:666">
                    <span>Material pétreo</span>
                    <span>y maquinaria</span>
                </div>
            </a>

            <nav class="main-nav" data-node-id="53:668">
                <a href="#servicios" class="nav-link">Servicios</a>
                <a href="#materiales" class="nav-link">Materiales</a>
                <a href="#nosotros" class="nav-link">Nosotros</a>
                <a href="#contacto" class="nav-link">Contacto</a>
            </nav>

            <div class="header-actions" data-node-id="53:677">
                @if($usuario)
                    <div class="user-session-pill">
                        <span>{{ $usuario->nombre_completo }}</span>
                        <span class="user-role-tag">{{ $usuario->rol }}</span>
                    </div>
                    <a href="{{ route('inventario.index') }}" class="btn-login-primary">
                        <span>Ir al Portal</span>
                        <span>↗</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-register-outline">Cerrar sesión</button>
                    </form>
                @else
                    <button type="button" class="btn-register-outline" onclick="abrirModal('registro')" data-node-id="53:678">
                        Registrarse
                    </button>
                    <button type="button" class="btn-login-primary" onclick="abrirModal('login')" data-node-id="53:680">
                        <span>Iniciar sesión</span>
                        <span>↗</span>
                    </button>
                @endif
            </div>
        </div>
    </header>

    <!-- ==================================================================
         CONTENIDO PRINCIPAL: 1. PANTALLA PRINCIPAL (Figma Node 53:355)
         ================================================================== -->
    <main id="inicio" data-node-id="53:356">

        <!-- HERO SECTION (Figma Node 53:357) -->
        <section class="hero-section" data-node-id="53:357">
            <div class="section-container hero-grid" data-node-id="53:358">
                <div class="hero-left" data-node-id="53:359">
                    <div class="eyebrow-row" data-node-id="53:360">
                        <div class="eyebrow-line"></div>
                        <span class="eyebrow-text">Paquisha · Zamora Chinchipe</span>
                    </div>

                    <h1 class="hero-heading" data-node-id="53:364">
                        La base sólida<br>
                        de tu <span class="text-blue">próxima</span><br>
                        obra.
                    </h1>

                    <p class="hero-description" data-node-id="53:366">
                        Material pétreo, transporte y maquinaria para construir con confianza.<br>
                        Cerca de ti, listos para trabajar.
                    </p>

                    <div class="hero-cta-row" data-node-id="53:367">
                        <button type="button" class="btn-hero-primary" onclick="abrirModal('login')" data-node-id="53:368">
                            <span>Pedir material</span>
                            <span>↗</span>
                        </button>
                        <a href="#servicios" class="btn-hero-secondary" data-node-id="53:372">
                            <span>Conoce nuestros servicios</span>
                            <span>↓</span>
                        </a>
                    </div>

                    <div class="hero-trust-row" data-node-id="53:376">
                        <div class="trust-avatars" data-node-id="53:377">
                            <div class="trust-circle c1">CJ</div>
                            <div class="trust-circle c2">EC</div>
                            <div class="trust-circle c3">✓</div>
                        </div>
                        <div class="trust-copy" data-node-id="53:387">
                            <strong>Servicio local, trato directo</strong>
                            <span>Conocemos el terreno y la zona.</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Derecha: Emblema de CALJIM (Figma Node 53:390) -->
                <div class="hero-emblem-card" data-node-id="53:390">
                    <div class="emblem-ring-outer"></div>
                    <div class="emblem-ring-inner"></div>
                    <span class="emblem-top-label" data-node-id="53:395">CALJIM · Construimos confianza</span>
                    <span class="emblem-coords" data-node-id="53:397">04°00′ S &nbsp; 78°45′ O</span>

                    <div class="emblem-circle-logo" data-node-id="53:398">
                        <img src="{{ asset('img/emblema-caljim.png') }}" alt="Emblema CALJIM azul y negro">
                    </div>

                    <div class="emblem-floating-card left" data-node-id="53:399">
                        <span class="floating-small">Atención en</span>
                        <strong class="floating-strong">Paquisha, Ecuador</strong>
                        <span class="floating-sub">Coordinamos según tu obra</span>
                    </div>

                    <div class="emblem-floating-card right" data-node-id="53:405">
                        <span class="floating-small">
                            <span class="status-green-dot"></span>
                            Disponibilidad
                        </span>
                        <strong class="floating-strong">Equipo listo</strong>
                        <span class="floating-sub">Material y maquinaria</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- BARRA DE 4 ÍCONOS (Figma Node 53:413) -->
        <section class="features-strip" data-node-id="53:413">
            <div class="features-strip-inner" data-node-id="53:414">
                <div class="strip-item" data-node-id="53:415">
                    <div class="strip-icon-box">
                        <img src="{{ asset('img/icon-entrega.svg') }}" width="19" height="19" alt="">
                    </div>
                    <span class="strip-label">Entrega coordinada</span>
                </div>

                <div class="strip-item" data-node-id="53:422">
                    <div class="strip-icon-box">
                        <img src="{{ asset('img/icon-material.svg') }}" width="19" height="19" alt="">
                    </div>
                    <span class="strip-label">Material para tu proyecto</span>
                </div>

                <div class="strip-item" data-node-id="53:427">
                    <div class="strip-icon-box">
                        <img src="{{ asset('img/icon-maquinaria.svg') }}" width="19" height="19" alt="">
                    </div>
                    <span class="strip-label">Alquiler de maquinaria</span>
                </div>

                <div class="strip-item" data-node-id="53:432">
                    <div class="strip-icon-box">
                        <img src="{{ asset('img/icon-ubicacion.svg') }}" width="19" height="19" alt="">
                    </div>
                    <span class="strip-label">Atención en Paquisha</span>
                </div>
            </div>
        </section>

        <!-- SECCIÓN SOLUCIONES (Figma Node 53:438) -->
        <section class="solutions-section" id="servicios" data-node-id="53:438">
            <div class="section-container" data-node-id="53:439">
                <div class="section-header-split" data-node-id="53:440">
                    <div>
                        <div class="eyebrow-row">
                            <div class="eyebrow-line"></div>
                            <span class="eyebrow-text">Lo que necesitas, en un solo lugar</span>
                        </div>
                        <h2 class="section-heading" data-node-id="53:445">
                            Soluciones para<br>cada etapa de obra.
                        </h2>
                    </div>
                    <p class="section-side-desc" data-node-id="53:447">
                        Desde preparar el terreno hasta mover el último viaje, te ayudamos a encontrar el equipo y el material adecuado.
                    </p>
                </div>

                <div class="solutions-grid" data-node-id="53:448">
                    <article class="solution-card" data-node-id="53:449">
                        <div class="solution-icon-box">
                            <img src="{{ asset('img/icon-sol-material.svg') }}" width="19" height="19" alt="">
                        </div>
                        <h3 class="solution-title">Material pétreo</h3>
                        <p class="solution-desc">
                            Consulta disponibilidad de arena, lastre, piedra, ripio y más para tu proyecto.
                        </p>
                        <button type="button" class="solution-link-btn" onclick="abrirModal('login')">
                            <span>Consultar materiales</span>
                            <span>→</span>
                        </button>
                    </article>

                    <article class="solution-card" data-node-id="53:461">
                        <div class="solution-icon-box">
                            <img src="{{ asset('img/icon-sol-transporte.svg') }}" width="19" height="19" alt="">
                        </div>
                        <h3 class="solution-title">Transporte en volqueta</h3>
                        <p class="solution-desc">
                            Coordinamos viajes y entregas según tu ubicación, acceso y volumen requerido.
                        </p>
                        <button type="button" class="solution-link-btn" onclick="abrirModal('login')">
                            <span>Solicitar un viaje</span>
                            <span>→</span>
                        </button>
                    </article>

                    <article class="solution-card" data-node-id="53:475">
                        <div class="solution-icon-box">
                            <img src="{{ asset('img/icon-sol-maquinaria.svg') }}" width="19" height="19" alt="">
                        </div>
                        <h3 class="solution-title">Maquinaria para obra</h3>
                        <p class="solution-desc">
                            Alquila volqueta con conductor o retroexcavadora por horas, con opción de operador.
                        </p>
                        <button type="button" class="solution-link-btn" onclick="abrirModal('login')">
                            <span>Ver disponibilidad</span>
                            <span>→</span>
                        </button>
                    </article>
                </div>
            </div>
        </section>

        <!-- SECCIÓN MATERIALES DE CONSTRUCCIÓN (Figma Node 53:487) -->
        <section class="materials-dark-section" id="materiales" data-node-id="53:487">
            <div class="section-container" data-node-id="53:488">
                <div class="section-header-split" data-node-id="53:489">
                    <div>
                        <div class="eyebrow-row">
                            <div class="eyebrow-line lime"></div>
                            <span class="eyebrow-text lime">Materiales de construcción</span>
                        </div>
                        <h2 class="section-heading white" data-node-id="53:494">
                            Lo esencial para<br>seguir avanzando.
                        </h2>
                    </div>
                    <p class="section-side-desc light" data-node-id="53:496">
                        Consulta existencias y precios con nuestro equipo. La disponibilidad se confirma antes de cada despacho.
                    </p>
                </div>

                <div class="materials-grid-4" data-node-id="53:497">
                    @php $simbolos = ['◈', '▧', '◌', '◇']; @endphp
                    @forelse($materiales as $index => $mat)
                        <article class="material-dark-card">
                            <div class="material-card-top">
                                <div class="material-symbol-box">{{ $simbolos[$index % 4] }}</div>
                                <span class="material-sample-badge">{{ $mat->stock_m3 > 0 ? 'Disponible' : 'Agotado' }}</span>
                            </div>
                            <h3 class="material-dark-title">{{ $mat->nombre }}</h3>
                            <p class="material-dark-meta">{{ number_format($mat->stock_m3, 0) }} m³ en stock · ${{ number_format($mat->precio_m3, 2) }}/m³</p>
                        </article>
                    @empty
                        <article class="material-dark-card" data-node-id="53:498">
                            <div class="material-card-top">
                                <div class="material-symbol-box">◈</div>
                                <span class="material-sample-badge">Disponible</span>
                            </div>
                            <h3 class="material-dark-title">Arena de río</h3>
                            <p class="material-dark-meta">86 m³ en stock · $18.00/m³</p>
                        </article>
                    @endforelse
                </div>

                <p class="materials-disclaimer" data-node-id="53:539">
                    Las cantidades que aparecen son datos de muestra para esta demostración. Confirma el stock y el precio con CALJIM antes de coordinar.
                </p>

                <div class="materials-bottom-bar" data-node-id="53:540">
                    <span class="materials-bottom-text">¿Buscas un material específico o necesitas varios viajes?</span>
                    <button type="button" class="btn-white-pill" onclick="abrirModal('login')" data-node-id="53:543">
                        <span>Cotizar mi pedido</span>
                        <span>↗</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- SECCIÓN NOSOTROS: TRABAJO SERIO (Figma Node 53:549) -->
        <section class="about-section" id="nosotros" data-node-id="53:549">
            <div class="section-container about-grid" data-node-id="53:550">
                <div class="about-visual-card" data-node-id="53:580">
                    <div class="about-circle-bg"></div>
                    <div class="about-emblem-img">
                        <img src="{{ asset('img/emblema-caljim.png') }}" alt="Emblema de CALJIM">
                    </div>
                    <div class="about-floating-tag" data-node-id="53:583">
                        <strong>CALJIM</strong>
                        <span>Con raíces en Paquisha</span>
                    </div>
                </div>

                <div data-node-id="53:551">
                    <div class="eyebrow-row">
                        <div class="eyebrow-line"></div>
                        <span class="eyebrow-text">Cerca de tu proyecto</span>
                    </div>
                    <h2 class="section-heading" data-node-id="53:556">
                        Trabajo serio.<br>De principio a fin.
                    </h2>
                    <p class="about-copy-paragraph" data-node-id="53:558">
                        Somos un equipo local dedicado a la venta de material pétreo y al alquiler de maquinaria. Acompañamos a constructores, familias y negocios de Zamora Chinchipe con atención directa y coordinación clara.
                    </p>

                    <div class="about-checks-grid" data-node-id="53:559">
                        <div class="about-check-item">
                            <span class="check-badge">✓</span>
                            <span>Asesoría para elegir el material</span>
                        </div>
                        <div class="about-check-item">
                            <span class="check-badge">✓</span>
                            <span>Coordinación de viajes</span>
                        </div>
                        <div class="about-check-item">
                            <span class="check-badge">✓</span>
                            <span>Maquinaria por horas</span>
                        </div>
                        <div class="about-check-item">
                            <span class="check-badge">✓</span>
                            <span>Atención local en Paquisha</span>
                        </div>
                    </div>

                    <button type="button" class="about-link" onclick="abrirModal('login')" data-node-id="53:576">
                        <span>Hablemos de tu obra</span>
                        <span>→</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- SECCIÓN ASÍ DE SENCILLO (Figma Node 53:586) -->
        <section class="steps-section" data-node-id="53:586">
            <div class="section-container" data-node-id="53:587">
                <div class="section-header-split" data-node-id="53:588">
                    <div>
                        <div class="eyebrow-row">
                            <div class="eyebrow-line"></div>
                            <span class="eyebrow-text">Así de sencillo</span>
                        </div>
                        <h2 class="section-heading" data-node-id="53:593">
                            De la consulta<br>a la entrega.
                        </h2>
                    </div>
                    <p class="section-side-desc" data-node-id="53:595">
                        Cuéntanos qué necesitas; nuestro equipo confirma disponibilidad, precio y horario contigo.
                    </p>
                </div>

                <div class="steps-grid" data-node-id="53:596">
                    <article class="step-card" data-node-id="53:597">
                        <span class="step-number">01 — CUÉNTANOS</span>
                        <h3 class="step-title">Describe tu proyecto</h3>
                        <p class="step-desc">
                            Elige el material, la cantidad y dinos dónde sería la entrega o el trabajo.
                        </p>
                    </article>

                    <article class="step-card" data-node-id="53:603">
                        <span class="step-number">02 — COORDINAMOS</span>
                        <h3 class="step-title">Confirmamos los detalles</h3>
                        <p class="step-desc">
                            Revisamos acceso, disponibilidad, precio y el tiempo estimado para atenderte.
                        </p>
                    </article>

                    <article class="step-card" data-node-id="53:609">
                        <span class="step-number">03 — AVANZAS</span>
                        <h3 class="step-title">Tu obra sigue adelante</h3>
                        <p class="step-desc">
                            Coordinamos el despacho o alquiler y mantenemos comunicación contigo.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- SECCIÓN BANNER CTA AZUL (Figma Node 53:615) -->
        <section class="cta-banner-section" id="contacto" data-node-id="53:615">
            <div class="section-container" data-node-id="53:616">
                <div class="cta-banner-box" data-node-id="53:617">
                    <div>
                        <h2 class="cta-banner-title">¿Qué necesita tu obra?</h2>
                        <p class="cta-banner-sub">Cuéntanos los detalles y te ayudamos a planificar el siguiente paso.</p>
                    </div>
                    <button type="button" class="btn-cta-white" onclick="abrirModal('login')" data-node-id="53:625">
                        <span>Empezar pedido</span>
                        <span>↗</span>
                    </button>
                </div>
            </div>
        </section>

    </main>

    <!-- ==================================================================
         FOOTER (Figma Node 53:629)
         ================================================================== -->
    <footer class="site-footer" data-node-id="53:629">
        <div class="section-container" data-node-id="53:630">
            <div class="footer-top" data-node-id="53:631">
                <div>
                    <div class="footer-logo-box" data-node-id="53:633">
                        <img src="{{ asset('img/logo-caljim-header.png') }}" alt="CALJIM">
                    </div>
                    <p class="footer-desc">
                        Material pétreo, transporte y maquinaria para proyectos de Zamora Chinchipe.
                    </p>
                </div>

                <div class="footer-cols" data-node-id="53:635">
                    <div class="footer-col">
                        <span class="footer-col-title">Explora</span>
                        <a href="#servicios" class="footer-link">Servicios</a>
                        <a href="#materiales" class="footer-link">Materiales</a>
                        <a href="#nosotros" class="footer-link">Nosotros</a>
                    </div>

                    <div class="footer-col">
                        <span class="footer-col-title">Atención</span>
                        <span class="footer-link">Paquisha, Zamora Chinchipe</span>
                        <button type="button" class="solution-link-btn" onclick="abrirModal('registro')">
                            <span>Solicitar información →</span>
                        </button>
                    </div>

                    <div class="footer-col">
                        <span class="footer-col-title">Portal</span>
                        <button type="button" class="solution-link-btn" onclick="abrirModal('login')">
                            <span>Acceso de equipo →</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="footer-bottom" data-node-id="53:657">
                <span>© 2026 CALJIM. Todos los derechos reservados.</span>
                <span>Paquisha · Ecuador</span>
            </div>
        </div>
    </footer>

    <!-- ==================================================================
         MODAL DE LOGUEO Y CREAR CUENTA (Figma Nodes 58:1112 & 58:1244)
         ================================================================== -->
    <div id="authModalBackdrop" class="auth-modal-backdrop {{ $mostrarModal ? '' : 'hidden' }}">
        <div class="auth-card" data-node-id="58:1112">
            <!-- Encabezado y botón cerrar -->
            <div class="auth-header">
                <div class="auth-title-wrap">
                    <h2 class="auth-title" id="authHeading">
                        {{ $modoInicial === 'registro' ? 'Crea tu cuenta CALJIM' : ($modoInicial === 'recuperar' ? 'Recuperar contraseña' : 'Bienvenido a CALJIM') }}
                    </h2>
                    <p class="auth-subtitle" id="authSubtitle">
                        {{ $modoInicial === 'registro' ? 'Registra tus datos para comenzar.' : ($modoInicial === 'recuperar' ? 'Verifica tu correo y teléfono para crear una nueva clave.' : 'Accede a tu espacio de trabajo.') }}
                    </p>
                </div>
                <button type="button" class="auth-close-btn" onclick="cerrarModal()" title="Cerrar">×</button>
            </div>

            <!-- Selector de pestañas: Crear cuenta (izquierda) | Iniciar sesión (derecha) -->
            <div class="auth-tabs-wrap" id="authTabsWrap">
                <div class="auth-tabs">
                    <button type="button" id="tabRegistro" class="auth-tab-btn {{ $modoInicial === 'registro' ? 'active' : '' }}" onclick="cambiarModo('registro')">
                        Crear cuenta
                    </button>
                    <button type="button" id="tabLogin" class="auth-tab-btn {{ $modoInicial === 'login' ? 'active' : '' }}" onclick="cambiarModo('login')">
                        Iniciar sesión
                    </button>
                </div>
            </div>

            <!-- Mensajes de éxito, validación o error de credenciales -->
            @if (session('auth_exito'))
                <div class="auth-alert-success">
                    {{ session('auth_exito') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="auth-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORMULARIO 1: INICIAR SESIÓN (Figma Node 58:1129) -->
            <form id="formLogin" action="{{ route('login.post') }}" method="POST" class="auth-form {{ $modoInicial !== 'login' ? 'hidden' : '' }}">
                @csrf
                <div class="auth-field">
                    <label for="login_email" class="auth-label">Correo electrónico</label>
                    <input
                        type="email"
                        id="login_email"
                        name="email"
                        value="{{ old('email') }}"
                        class="auth-input"
                        placeholder="Tu correo electrónico"
                        required
                        autocomplete="email"
                    >
                </div>

                <div class="auth-field auth-field-spaced">
                    <div class="auth-label-row">
                        <label for="login_password" class="auth-label">Contraseña</label>
                        <button type="button" class="auth-forgot-link" onclick="cambiarModo('recuperar')">
                            ¿Olvidaste tu contraseña?
                        </button>
                    </div>
                    <div class="auth-input-wrap">
                        <input
                            type="password"
                            id="login_password"
                            name="password"
                            class="auth-input has-toggle"
                            placeholder="Tu contraseña"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="auth-toggle-pass" onclick="togglePass('login_password', this)" aria-label="Mostrar u ocultar contraseña">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="auth-submit-btn">
                    <span>Ingresar al portal</span>
                    <span>↗</span>
                </button>
            </form>

            <!-- FORMULARIO 2: CREAR CUENTA (Figma Node 58:1261) -->
            <form id="formRegistro" action="{{ route('registro.post') }}" method="POST" class="auth-form {{ $modoInicial !== 'registro' ? 'hidden' : '' }}">
                @csrf
                <div class="auth-grid-2col">
                    <div class="auth-field">
                        <label for="reg_nombre" class="auth-label">Nombres y apellidos</label>
                        <input
                            type="text"
                            id="reg_nombre"
                            name="nombre_completo"
                            value="{{ old('nombre_completo') }}"
                            class="auth-input"
                            placeholder="Tu nombre completo"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="reg_rol" class="auth-label">Tipo de cuenta</label>
                        <input
                            type="text"
                            id="reg_rol"
                            class="auth-input"
                            value="Cliente"
                            readonly
                            style="background-color: #f8fafc; color: #475569; cursor: not-allowed;"
                        >
                    </div>

                    <div class="auth-field">
                        <label for="reg_email" class="auth-label">Correo electrónico</label>
                        <input
                            type="email"
                            id="reg_email"
                            name="email"
                            value="{{ old('email') }}"
                            class="auth-input"
                            placeholder="Tu correo electrónico"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="reg_telefono" class="auth-label">Teléfono</label>
                        <input
                            type="text"
                            id="reg_telefono"
                            name="telefono"
                            value="{{ old('telefono') }}"
                            class="auth-input"
                            placeholder="09XXXXXXXX"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="reg_password" class="auth-label">Crear contraseña</label>
                        <div class="auth-input-wrap">
                            <input
                                type="password"
                                id="reg_password"
                                name="password"
                                class="auth-input has-toggle"
                                placeholder="Mínimo 8 caracteres"
                                minlength="8"
                                pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9\s]).{8,}"
                                title="Debe tener mínimo 8 caracteres, al menos una letra, un número y un carácter especial (ej. @$!%*?&.#_-)"
                                oninput="evaluarFuerza(); verificarCoincidencia();"
                                required
                            >
                            <button type="button" class="auth-toggle-pass" onclick="togglePass('reg_password', this)" aria-label="Mostrar u ocultar contraseña">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label for="reg_password_confirmation" class="auth-label">Confirmar contraseña</label>
                        <div class="auth-input-wrap">
                            <input
                                type="password"
                                id="reg_password_confirmation"
                                name="password_confirmation"
                                class="auth-input has-toggle"
                                placeholder="Repite tu contraseña"
                                minlength="8"
                                oninput="verificarCoincidencia();"
                                required
                            >
                            <button type="button" class="auth-toggle-pass" onclick="togglePass('reg_password_confirmation', this)" aria-label="Mostrar u ocultar contraseña">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <span id="passMatchMsg" class="pass-match-msg"></span>
                    </div>

                    <div class="auth-field auth-col-span-2">
                        <div class="pass-strength-box">
                            <div class="pass-strength-header">
                                <span>Nivel de seguridad:</span>
                                <span id="passStrengthLabel" class="pass-strength-label">Ingresa una contraseña</span>
                            </div>
                            <div class="pass-strength-bar">
                                <div id="passStrengthFill" class="pass-strength-fill"></div>
                            </div>
                            <ul class="pass-rules-list">
                                <li id="ruleLength" class="pass-rule-item">○ Mínimo 8 caracteres</li>
                                <li id="ruleAlphaNum" class="pass-rule-item">○ Letras y números</li>
                                <li id="ruleSpecial" class="pass-rule-item">○ Carácter especial (@$!%*?&.#_-)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="auth-field auth-col-span-2">
                        <label for="reg_captcha" class="auth-label">Verificación de seguridad (CAPTCHA)</label>
                        <div class="captcha-row">
                            <div class="captcha-img-box">
                                <img id="captchaImg" src="{{ route('captcha.svg') }}" alt="Código de verificación">
                                <button type="button" class="captcha-refresh-btn" onclick="recargarCaptcha()" title="Generar otro código">↻</button>
                            </div>
                            <input
                                type="text"
                                id="reg_captcha"
                                name="captcha"
                                class="auth-input"
                                placeholder="Escribe los 5 caracteres de la imagen"
                                maxlength="5"
                                autocomplete="off"
                                required
                            >
                        </div>
                    </div>
                </div>

                <p class="auth-terms">
                    Tus datos se usarán para gestionar pedidos. Al crear una cuenta aceptas que CALJIM los use para atender tu solicitud.
                </p>

                <button type="submit" class="auth-submit-btn">
                    <span>Crear cuenta y continuar</span>
                    <span>↗</span>
                </button>
            </form>

            <!-- FORMULARIO 3: RECUPERAR CONTRASEÑA (3 PASOS ESTILO GOOGLE) -->
            <div id="formRecuperar" class="auth-form {{ $modoInicial !== 'recuperar' ? 'hidden' : '' }}">
                @if($pasoRecuperar === 1)
                    <!-- PASO 1: Menú estilo Google para elegir método -->
                    @php
                        $metodoRec = old('metodo', '');
                        $tieneErrorPaso1 = $errors->has('email') || $errors->has('telefono') || $metodoRec !== '';
                    @endphp

                    <div id="recMenuOpciones" class="{{ $tieneErrorPaso1 ? 'hidden' : '' }}">
                        <p class="auth-label" style="margin-bottom:10px;">Elige cómo deseas verificar tu identidad:</p>
                        <div class="rec-options-list">
                            <button type="button" class="rec-option-btn" onclick="seleccionarMetodoRec('email')">
                                <span class="rec-option-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <span>
                                    <span class="rec-option-title">Obtener un código en tu correo electrónico</span>
                                    <span class="rec-option-sub">Enviaremos un código de verificación de 6 dígitos</span>
                                </span>
                                <span class="rec-option-arrow">›</span>
                            </button>

                            <button type="button" class="rec-option-btn" onclick="seleccionarMetodoRec('telefono')">
                                <span class="rec-option-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                </span>
                                <span>
                                    <span class="rec-option-title">Obtener un código en tu número de celular</span>
                                    <span class="rec-option-sub">Verificación mediante SMS al teléfono registrado</span>
                                </span>
                                <span class="rec-option-arrow">›</span>
                            </button>
                        </div>
                    </div>

                    <form id="recInputForm" action="{{ route('password.code.post') }}" method="POST" class="{{ $tieneErrorPaso1 ? '' : 'hidden' }}">
                        @csrf
                        <input type="hidden" id="rec_metodo" name="metodo" value="{{ $metodoRec ?: 'email' }}">

                        <div class="auth-field {{ $metodoRec === 'telefono' ? 'hidden' : '' }}" id="recWrapEmail">
                            <label for="rec_email" class="auth-label">Correo electrónico registrado</label>
                            <input
                                type="email"
                                id="rec_email"
                                name="email"
                                value="{{ old('email') }}"
                                class="auth-input"
                                placeholder="Tu correo electrónico"
                                {{ $metodoRec !== 'telefono' ? 'required' : 'disabled' }}
                            >
                        </div>

                        <div class="auth-field {{ $metodoRec === 'telefono' ? '' : 'hidden' }}" id="recWrapTelefono">
                            <label for="rec_telefono" class="auth-label">Número de celular registrado</label>
                            <input
                                type="text"
                                id="rec_telefono"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                class="auth-input"
                                placeholder="09XXXXXXXX"
                                {{ $metodoRec === 'telefono' ? 'required' : 'disabled' }}
                            >
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            <span>Enviar código de verificación</span>
                            <span>↗</span>
                        </button>

                        <div class="auth-back-row">
                            <button type="button" class="auth-forgot-link" onclick="volverMenuMetodos()">
                                Probar otra forma de verificar
                            </button>
                        </div>
                    </form>

                @elseif($pasoRecuperar === 2)
                    <!-- PASO 2: Ingresar el código de 6 dígitos -->
                    <form action="{{ route('password.verify.post') }}" method="POST">
                        @csrf
                        <div class="auth-alert-success" style="margin-top:0; margin-bottom:16px; background:#edf2ff; border-color:#c7d2fe; color:#1e3a8a;">
                            Enviamos un código de 6 dígitos a <strong>{{ $recDestino }}</strong>.
                            @if($recCodigoDemo)
                                <div style="margin-top:4px; font-size:12px;">
                                    Código generado (entorno local): <strong style="font-size:14px; letter-spacing:2px;">{{ $recCodigoDemo }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="auth-field">
                            <label for="rec_codigo" class="auth-label">Código de verificación (6 dígitos)</label>
                            <input
                                type="text"
                                id="rec_codigo"
                                name="codigo"
                                class="auth-input"
                                placeholder="Ej. 482915"
                                maxlength="6"
                                pattern="\d{6}"
                                inputmode="numeric"
                                autocomplete="one-time-code"
                                required
                            >
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            <span>Verificar código</span>
                            <span>↗</span>
                        </button>

                        <div class="auth-back-row">
                            <a href="{{ route('password.restart') }}" class="auth-forgot-link">
                                ← Usar otro correo o celular
                            </a>
                        </div>
                    </form>

                @else
                    <!-- PASO 3: Crear la nueva contraseña segura -->
                    <form action="{{ route('password.reset.post') }}" method="POST">
                        @csrf
                        <div class="auth-alert-success" style="margin-top:0; margin-bottom:16px;">
                            ✓ Identidad verificada para <strong>{{ $recDestino }}</strong>. Crea tu nueva contraseña.
                        </div>

                        <div class="auth-grid-2col">
                            <div class="auth-field">
                                <label for="rec_password" class="auth-label">Nueva contraseña</label>
                                <div class="auth-input-wrap">
                                    <input
                                        type="password"
                                        id="rec_password"
                                        name="password"
                                        class="auth-input has-toggle"
                                        placeholder="Mínimo 8 caracteres"
                                        minlength="8"
                                        pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9\s]).{8,}"
                                        title="Debe tener mínimo 8 caracteres, al menos una letra, un número y un carácter especial"
                                        oninput="evaluarFuerzaRecuperar(); verificarCoincidenciaRecuperar();"
                                        required
                                    >
                                    <button type="button" class="auth-toggle-pass" onclick="togglePass('rec_password', this)" aria-label="Mostrar u ocultar contraseña">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="auth-field">
                                <label for="rec_password_confirmation" class="auth-label">Confirmar contraseña</label>
                                <div class="auth-input-wrap">
                                    <input
                                        type="password"
                                        id="rec_password_confirmation"
                                        name="password_confirmation"
                                        class="auth-input has-toggle"
                                        placeholder="Repite la nueva contraseña"
                                        minlength="8"
                                        oninput="verificarCoincidenciaRecuperar();"
                                        required
                                    >
                                    <button type="button" class="auth-toggle-pass" onclick="togglePass('rec_password_confirmation', this)" aria-label="Mostrar u ocultar contraseña">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                <span id="recMatchMsg" class="pass-match-msg"></span>
                            </div>

                            <div class="auth-field auth-col-span-2">
                                <div class="pass-strength-box">
                                    <div class="pass-strength-header">
                                        <span>Nivel de seguridad:</span>
                                        <span id="recStrengthLabel" class="pass-strength-label">Ingresa una contraseña</span>
                                    </div>
                                    <div class="pass-strength-bar">
                                        <div id="recStrengthFill" class="pass-strength-fill"></div>
                                    </div>
                                    <ul class="pass-rules-list">
                                        <li id="recRuleLength" class="pass-rule-item">○ Mínimo 8 caracteres</li>
                                        <li id="recRuleAlphaNum" class="pass-rule-item">○ Letras y números</li>
                                        <li id="recRuleSpecial" class="pass-rule-item">○ Carácter especial (@$!%*?&.#_-)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            <span>Actualizar contraseña</span>
                            <span>↗</span>
                        </button>
                    </form>
                @endif

                <div class="auth-back-row">
                    <button type="button" class="auth-forgot-link" onclick="cambiarModo('login')">
                        ← Volver a Iniciar sesión
                    </button>
                </div>
            </div>

            <!-- Sección inferior de Vistas de Demostración (oculta al recuperar contraseña) -->
            <div id="authDemoSection" class="{{ $modoInicial === 'recuperar' ? 'hidden' : '' }}">
                <!-- Separador VISTAS DE DEMOSTRACIÓN -->
                <div class="auth-divider">
                    <div class="auth-divider-line"></div>
                    <span class="auth-divider-text">VISTAS DE DEMOSTRACIÓN</span>
                    <div class="auth-divider-line"></div>
                </div>

                <!-- Caja de acceso rápido por roles (RBAC) -->
                <div class="auth-demo-wrap">
                    <div class="auth-demo-box">
                        <p class="auth-demo-title">Explora los paneles con información ficticia</p>
                        <div class="auth-demo-grid">
                            <a href="{{ route('login.demo', ['perfil' => 'admin1']) }}" class="auth-demo-pill">
                                Admin · Perfil 1
                            </a>
                            <a href="{{ route('login.demo', ['perfil' => 'admin2']) }}" class="auth-demo-pill">
                                Admin · Perfil 2
                            </a>
                            <a href="{{ route('login.demo', ['perfil' => 'trabajador']) }}" class="auth-demo-pill">
                                Trabajador
                            </a>
                            <a href="{{ route('login.demo', ['perfil' => 'cliente']) }}" class="auth-demo-pill">
                                Cliente
                            </a>
                        </div>
                    </div>
                </div>

                <p class="auth-footer-note">
                    Prototipo público con información ficticia. No uses contraseñas ni datos personales reales. Las cuentas y cambios solo se guardan en este navegador.
                </p>
            </div>
        </div>
    </div>

    <script>
        let pasoRecuperarActivo = {{ $pasoRecuperar }};

        function abrirModal(modo) {
            const backdrop = document.getElementById('authModalBackdrop');
            backdrop.classList.remove('hidden');
            cambiarModo(modo || 'login');
        }

        function cerrarModal() {
            const backdrop = document.getElementById('authModalBackdrop');
            backdrop.classList.add('hidden');
            if (pasoRecuperarActivo > 1) {
                fetch("{{ route('password.restart') }}?ajax=1").then(() => {
                    pasoRecuperarActivo = 1;
                });
            }
        }

        function cerrarModalSiFondo(event) {
            if (event.target.id === 'authModalBackdrop') {
                cerrarModal();
            }
        }

        function cambiarModo(modo) {
            const formLogin = document.getElementById('formLogin');
            const formRegistro = document.getElementById('formRegistro');
            const formRecuperar = document.getElementById('formRecuperar');
            const tabLogin = document.getElementById('tabLogin');
            const tabRegistro = document.getElementById('tabRegistro');
            const demoSection = document.getElementById('authDemoSection');
            const heading = document.getElementById('authHeading');
            const subtitle = document.getElementById('authSubtitle');

            formLogin.classList.add('hidden');
            formRegistro.classList.add('hidden');
            formRecuperar.classList.add('hidden');
            tabLogin.classList.remove('active');
            tabRegistro.classList.remove('active');
            if (demoSection) demoSection.classList.remove('hidden');

            if (modo === 'registro') {
                if (pasoRecuperarActivo > 1) {
                    fetch("{{ route('password.restart') }}?ajax=1").then(() => { pasoRecuperarActivo = 1; });
                }
                formRegistro.classList.remove('hidden');
                tabRegistro.classList.add('active');
                heading.textContent = 'Crea tu cuenta CALJIM';
                subtitle.textContent = 'Registra tus datos para comenzar.';
                recargarCaptcha();
            } else if (modo === 'recuperar') {
                if (pasoRecuperarActivo > 1 && formRecuperar.classList.contains('hidden')) {
                    window.location.href = "{{ route('password.restart') }}";
                    return;
                }
                formRecuperar.classList.remove('hidden');
                if (demoSection) demoSection.classList.add('hidden');
                tabLogin.classList.add('active');
                heading.textContent = 'Recuperar contraseña';
                subtitle.textContent = 'Verifica tu identidad para crear una nueva clave.';
            } else {
                if (pasoRecuperarActivo > 1) {
                    fetch("{{ route('password.restart') }}?ajax=1").then(() => { pasoRecuperarActivo = 1; });
                }
                formLogin.classList.remove('hidden');
                tabLogin.classList.add('active');
                heading.textContent = 'Bienvenido a CALJIM';
                subtitle.textContent = 'Accede a tu espacio de trabajo.';
            }
        }

        const svgOjoAbierto = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        const svgOjoCerrado = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';

        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = svgOjoCerrado;
            } else {
                input.type = 'password';
                btn.innerHTML = svgOjoAbierto;
            }
        }

        function evaluarFuerzaPassword(inputId, fillId, labelId, ruleLenId, ruleAlphaNumId, ruleSpecialId) {
            const pass = document.getElementById(inputId).value;
            const fill = document.getElementById(fillId);
            const label = document.getElementById(labelId);
            const ruleLen = document.getElementById(ruleLenId);
            const ruleAlphaNum = document.getElementById(ruleAlphaNumId);
            const ruleSpecial = document.getElementById(ruleSpecialId);

            const tieneLen = pass.length >= 8;
            const tieneLetra = /[a-zA-Z]/.test(pass);
            const tieneNumero = /[0-9]/.test(pass);
            const tieneAlphaNum = tieneLetra && tieneNumero;
            const tieneEspecial = /[^a-zA-Z0-9\s]/.test(pass);

            ruleLen.className = 'pass-rule-item' + (tieneLen ? ' ok' : '');
            ruleLen.textContent = (tieneLen ? '✓ ' : '○ ') + 'Mínimo 8 caracteres';

            ruleAlphaNum.className = 'pass-rule-item' + (tieneAlphaNum ? ' ok' : '');
            ruleAlphaNum.textContent = (tieneAlphaNum ? '✓ ' : '○ ') + 'Letras y números';

            ruleSpecial.className = 'pass-rule-item' + (tieneEspecial ? ' ok' : '');
            ruleSpecial.textContent = (tieneEspecial ? '✓ ' : '○ ') + 'Carácter especial (@$!%*?&.#_-)';

            fill.className = 'pass-strength-fill';
            label.className = 'pass-strength-label';

            if (pass.length === 0) {
                label.textContent = 'Ingresa una contraseña';
                return;
            }

            let puntaje = 0;
            if (tieneLen) puntaje++;
            if (tieneAlphaNum) puntaje++;
            if (tieneEspecial) puntaje++;

            if (puntaje <= 1 || !tieneLen) {
                fill.classList.add('debil');
                label.classList.add('debil');
                label.textContent = 'Débil';
            } else if (puntaje === 2) {
                fill.classList.add('media');
                label.classList.add('media');
                label.textContent = 'Media';
            } else {
                fill.classList.add('fuerte');
                label.classList.add('fuerte');
                label.textContent = 'Segura';
            }
        }

        function evaluarFuerza() {
            evaluarFuerzaPassword('reg_password', 'passStrengthFill', 'passStrengthLabel', 'ruleLength', 'ruleAlphaNum', 'ruleSpecial');
        }

        function evaluarFuerzaRecuperar() {
            evaluarFuerzaPassword('rec_password', 'recStrengthFill', 'recStrengthLabel', 'recRuleLength', 'recRuleAlphaNum', 'recRuleSpecial');
        }

        function verificarCoincidencia() {
            const p1 = document.getElementById('reg_password').value;
            const p2Input = document.getElementById('reg_password_confirmation');
            const p2 = p2Input.value;
            const msg = document.getElementById('passMatchMsg');

            if (p2.length === 0) {
                msg.textContent = '';
                msg.className = 'pass-match-msg';
                p2Input.setCustomValidity('');
                return;
            }

            if (p1 === p2) {
                msg.textContent = '✓ Las contraseñas coinciden';
                msg.className = 'pass-match-msg ok';
                p2Input.setCustomValidity('');
            } else {
                msg.textContent = '✕ Las contraseñas no coinciden';
                msg.className = 'pass-match-msg err';
                p2Input.setCustomValidity('Las contraseñas no coinciden.');
            }
        }

        function seleccionarMetodoRec(metodo) {
            const menu = document.getElementById('recMenuOpciones');
            const form = document.getElementById('recInputForm');
            const hiddenMetodo = document.getElementById('rec_metodo');
            const wrapEmail = document.getElementById('recWrapEmail');
            const wrapTel = document.getElementById('recWrapTelefono');
            const inputEmail = document.getElementById('rec_email');
            const inputTel = document.getElementById('rec_telefono');

            if (!menu || !form) return;

            menu.classList.add('hidden');
            form.classList.remove('hidden');
            hiddenMetodo.value = metodo;

            if (metodo === 'telefono') {
                wrapEmail.classList.add('hidden');
                inputEmail.disabled = true;
                inputEmail.required = false;

                wrapTel.classList.remove('hidden');
                inputTel.disabled = false;
                inputTel.required = true;
                inputTel.focus();
            } else {
                wrapTel.classList.add('hidden');
                inputTel.disabled = true;
                inputTel.required = false;

                wrapEmail.classList.remove('hidden');
                inputEmail.disabled = false;
                inputEmail.required = true;
                inputEmail.focus();
            }
        }

        function volverMenuMetodos() {
            const menu = document.getElementById('recMenuOpciones');
            const form = document.getElementById('recInputForm');
            if (menu && form) {
                form.classList.add('hidden');
                menu.classList.remove('hidden');
            }
        }

        function verificarCoincidenciaRecuperar() {
            const p1 = document.getElementById('rec_password').value;
            const p2Input = document.getElementById('rec_password_confirmation');
            const p2 = p2Input.value;
            const msg = document.getElementById('recMatchMsg');

            if (p2.length === 0) {
                msg.textContent = '';
                msg.className = 'pass-match-msg';
                p2Input.setCustomValidity('');
                return;
            }

            if (p1 === p2) {
                msg.textContent = '✓ Las contraseñas coinciden';
                msg.className = 'pass-match-msg ok';
                p2Input.setCustomValidity('');
            } else {
                msg.textContent = '✕ Las contraseñas no coinciden';
                msg.className = 'pass-match-msg err';
                p2Input.setCustomValidity('Las contraseñas no coinciden.');
            }
        }

        function recargarCaptcha() {
            const ts = Date.now();
            const img = document.getElementById('captchaImg');
            const imgRec = document.getElementById('captchaImgRec');
            if (img) img.src = "{{ route('captcha.svg') }}?t=" + ts;
            if (imgRec) imgRec.src = "{{ route('captcha.svg') }}?t=" + ts;
            const cap1 = document.getElementById('reg_captcha');
            const cap2 = document.getElementById('rec_captcha');
            if (cap1) cap1.value = '';
            if (cap2) cap2.value = '';
        }
    </script>
</body>
</html>
