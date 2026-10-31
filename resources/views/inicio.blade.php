<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALJIM — Hola Mundo MVC (Laravel 11)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <!-- Hoja de estilos desacoplada en public/css/estilos.css -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <div class="container">
        <header class="hero">
            <div class="hero-top">
                <div class="brand-box">
                    <!-- Imagen cargada desde la carpeta public/img/Logo.png -->
                    <img src="{{ asset('img/Logo.png') }}" alt="Logo CALJIM" class="brand-logo">
                    <span class="badge">Entorno de Desarrollo Configurado</span>
                </div>
            </div>
            <h1>¡Hola Mundo desde <span>CALJIM</span>!</h1>
            <p class="subtitle">
                Plataforma Operativa estructurada con <strong>PHP {{ $phpVersion }}</strong> y el framework <strong>Laravel {{ $laravelVersion }}</strong> bajo arquitectura <strong>MVC (Modelo-Vista-Controlador)</strong>.
            </p>
            <div class="actions">
                <a href="{{ route('comprobante.pdf') }}" target="_blank" class="btn btn-primary">
                    Generar Comprobante PDF de Prueba (DomPDF)
                </a>
            </div>
        </header>

        <div class="grid">
            <!-- Estado del Servidor y Base de Datos -->
            <section class="card">
                <h2>
                    Estado del Stack Tecnológico
                    @if($dbConectada)
                        <span class="status-ok">MySQL Conectado</span>
                    @else
                        <span class="status-warn">MySQL Pendiente</span>
                    @endif
                </h2>
                <ul class="list-meta">
                    <li><span>Backend PHP:</span> <code>PHP {{ $phpVersion }}</code></li>
                    <li><span>Framework MVC:</span> <code>Laravel v{{ $laravelVersion }}</code></li>
                    <li><span>Motor Base de Datos:</span> <code>{{ $dbConectada ? 'MySQL/MariaDB ' . $motorVersion : 'Verificar puerto 3306' }}</code></li>
                    <li><span>Servicio PDF:</span> <code>barryvdh/laravel-dompdf</code></li>
                </ul>
                <p class="db-detail">
                    <strong>Detalle BD:</strong> {{ $dbMensaje }}
                </p>
            </section>

            <!-- Explicación de la Arquitectura MVC y Carpetas de Recursos -->
            <section class="card">
                <h2>Arquitectura MVC y Recursos</h2>
                <ul class="list-meta">
                    <li><span>Controlador (C):</span> <code>app/Http/Controllers/InicioController.php</code></li>
                    <li><span>Modelo (M):</span> <code>app/Models/Material.php</code></li>
                    <li><span>Vista (V):</span> <code>resources/views/inicio.blade.php</code></li>
                    <li><span>Carpeta Estilos:</span> <code>public/css/estilos.css</code></li>
                    <li><span>Carpeta Fotos:</span> <code>public/img/Logo.png</code></li>
                </ul>
                <div class="team-tags">
                    @foreach($equipo as $integrante)
                        <span class="team-tag">{{ $integrante }}</span>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</body>
</html>
