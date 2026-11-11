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
                    <article class="material-dark-card" data-node-id="53:498">
                        <div class="material-card-top">
                            <div class="material-symbol-box">◈</div>
                            <span class="material-sample-badge">Muestra</span>
                        </div>
                        <h3 class="material-dark-title">Arena de río</h3>
                        <p class="material-dark-meta">86 m³ de referencia · cotiza disponibilidad</p>
                    </article>

                    <article class="material-dark-card" data-node-id="53:508">
                        <div class="material-card-top">
                            <div class="material-symbol-box">▧</div>
                            <span class="material-sample-badge">Muestra</span>
                        </div>
                        <h3 class="material-dark-title">Lastre</h3>
                        <p class="material-dark-meta">142 m³ de referencia · cotiza disponibilidad</p>
                    </article>

                    <article class="material-dark-card" data-node-id="53:518">
                        <div class="material-card-top">
                            <div class="material-symbol-box">◌</div>
                            <span class="material-sample-badge">Muestra</span>
                        </div>
                        <h3 class="material-dark-title">Ripio</h3>
                        <p class="material-dark-meta">72 m³ de referencia · cotiza disponibilidad</p>
                    </article>

                    <article class="material-dark-card" data-node-id="53:528">
                        <div class="material-card-top">
                            <div class="material-symbol-box">◇</div>
                            <span class="material-sample-badge">Muestra</span>
                        </div>
                        <h3 class="material-dark-title">Piedra bola</h3>
                        <p class="material-dark-meta">55 m³ de referencia · cotiza disponibilidad</p>
                    </article>
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
    <div id="authModalBackdrop" class="auth-modal-backdrop {{ $mostrarModal ? '' : 'hidden' }}" onclick="cerrarModalSiFondo(event)">
        <div class="auth-card" data-node-id="58:1112">
            <!-- Encabezado y botón cerrar -->
            <div class="auth-header">
                <div class="auth-title-wrap">
                    <h2 class="auth-title" id="authHeading">
                        {{ $modoInicial === 'registro' ? 'Crea tu cuenta CALJIM' : 'Bienvenido a CALJIM' }}
                    </h2>
                    <p class="auth-subtitle" id="authSubtitle">
                        {{ $modoInicial === 'registro' ? 'Registra tus datos para comenzar.' : 'Accede a tu espacio de trabajo.' }}
                    </p>
                </div>
                <button type="button" class="auth-close-btn" onclick="cerrarModal()" title="Cerrar">×</button>
            </div>

            <!-- Selector de pestañas: Iniciar sesión | Crear cuenta -->
            <div class="auth-tabs-wrap">
                <div class="auth-tabs">
                    <button type="button" id="tabLogin" class="auth-tab-btn {{ $modoInicial === 'login' ? 'active' : '' }}" onclick="cambiarModo('login')">
                        Iniciar sesión
                    </button>
                    <button type="button" id="tabRegistro" class="auth-tab-btn {{ $modoInicial === 'registro' ? 'active' : '' }}" onclick="cambiarModo('registro')">
                        Crear cuenta
                    </button>
                </div>
            </div>

            <!-- Mensajes de validación o error de credenciales -->
            @if ($errors->any())
                <div class="auth-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORMULARIO 1: INICIAR SESIÓN (Figma Node 58:1129) -->
            <form id="formLogin" action="{{ route('login.post') }}" method="POST" class="auth-form {{ $modoInicial === 'registro' ? 'hidden' : '' }}">
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
                    <label for="login_password" class="auth-label">Contraseña</label>
                    <input
                        type="password"
                        id="login_password"
                        name="password"
                        class="auth-input"
                        placeholder="Tu contraseña"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="auth-submit-btn">
                    <span>Ingresar al portal</span>
                    <span>↗</span>
                </button>
            </form>

            <!-- FORMULARIO 2: CREAR CUENTA (Figma Node 58:1261) -->
            <form id="formRegistro" action="{{ route('registro.post') }}" method="POST" class="auth-form {{ $modoInicial === 'login' ? 'hidden' : '' }}">
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
                        <div class="auth-select-wrap">
                            <select id="reg_rol" name="rol" class="auth-select" required>
                                <option value="cliente" {{ old('rol') === 'cliente' ? 'selected' : '' }}>Cliente</option>
                                <option value="operario" {{ old('rol') === 'operario' ? 'selected' : '' }}>Trabajador / Operario</option>
                                <option value="admin" {{ old('rol') === 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                            <span class="auth-select-icon">
                                <img src="{{ asset('img/chevron-down.svg') }}" width="10" height="6" alt="">
                            </span>
                        </div>
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

                    <div class="auth-field auth-col-span-2">
                        <label for="reg_password" class="auth-label">Crear contraseña</label>
                        <input
                            type="password"
                            id="reg_password"
                            name="password"
                            class="auth-input"
                            placeholder="Mínimo 6 caracteres"
                            minlength="6"
                            required
                        >
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

    <script>
        function abrirModal(modo) {
            const backdrop = document.getElementById('authModalBackdrop');
            backdrop.classList.remove('hidden');
            cambiarModo(modo || 'login');
        }

        function cerrarModal() {
            const backdrop = document.getElementById('authModalBackdrop');
            backdrop.classList.add('hidden');
        }

        function cerrarModalSiFondo(event) {
            if (event.target.id === 'authModalBackdrop') {
                cerrarModal();
            }
        }

        function cambiarModo(modo) {
            const formLogin = document.getElementById('formLogin');
            const formRegistro = document.getElementById('formRegistro');
            const tabLogin = document.getElementById('tabLogin');
            const tabRegistro = document.getElementById('tabRegistro');
            const heading = document.getElementById('authHeading');
            const subtitle = document.getElementById('authSubtitle');

            if (modo === 'registro') {
                formLogin.classList.add('hidden');
                formRegistro.classList.remove('hidden');
                tabLogin.classList.remove('active');
                tabRegistro.classList.add('active');
                heading.textContent = 'Crea tu cuenta CALJIM';
                subtitle.textContent = 'Registra tus datos para comenzar.';
            } else {
                formRegistro.classList.add('hidden');
                formLogin.classList.remove('hidden');
                tabRegistro.classList.remove('active');
                tabLogin.classList.add('active');
                heading.textContent = 'Bienvenido a CALJIM';
                subtitle.textContent = 'Accede a tu espacio de trabajo.';
            }
        }
    </script>
</body>
</html>
