<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALJIM — Inventario de Materiales</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ filemtime(public_path('css/estilos.css')) }}">
</head>
<body>
    <div class="dash-shell" data-node-id="77:861">
        <!-- ==============================================================
             SIDEBAR OSCURO (Figma Node 77:1232)
             ============================================================== -->
        <aside class="dash-sidebar" data-node-id="77:1232">
            <div class="dash-brand-row">
                <div class="dash-logo-box">
                    <img src="{{ asset('img/logo-caljim-header.png') }}" alt="CALJIM">
                </div>
                <div class="dash-portal-label">
                    Portal de<br>operaciones
                </div>
            </div>

            <div class="dash-menu-heading">Menú principal</div>

            <nav class="dash-nav">
                @if($usuario->rol === 'admin')
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Resumen</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Pedidos</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <a href="{{ route('inventario.index') }}" class="dash-nav-item active">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Inventario</span>
                    </a>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Flota y equipos</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Personal y clientes</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Jornadas y reportes</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                @elseif($usuario->rol === 'operario')
                    <a href="{{ route('inventario.index') }}" class="dash-nav-item active">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Inventario</span>
                    </a>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Mi jornada</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Equipo asignado</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Mis datos</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                @else
                    <a href="{{ route('inventario.index') }}" class="dash-nav-item active">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Inventario</span>
                    </a>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Mis pedidos</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Nuevo pedido</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Seguimiento</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                    <span class="dash-nav-item disabled">
                        <img src="{{ asset('img/icon-menu-mark.svg') }}" width="20" height="20" alt="">
                        <span>Mis datos</span>
                        <span class="dash-nav-soon">Pronto</span>
                    </span>
                @endif
            </nav>

            <div class="dash-sidebar-footer">
                @php
                    $palabras = explode(' ', trim($usuario->nombre_completo));
                    $iniciales = strtoupper(substr($palabras[0] ?? 'U', 0, 1) . substr($palabras[1] ?? '', 0, 1));
                @endphp
                <div class="dash-avatar">{{ $iniciales }}</div>
                <div class="dash-user-info">
                    <div class="dash-user-name">{{ $usuario->nombre_completo }}</div>
                    <div class="dash-user-role">
                        {{ $usuario->rol === 'admin' ? 'Administrador' : ($usuario->rol === 'operario' ? 'Operario / Conductor' : 'Cliente') }}
                    </div>
                </div>
                <a href="{{ route('inicio') }}" class="dash-home-btn" title="Ir a la página pública">↗</a>
            </div>
        </aside>

        <!-- ==============================================================
             CONTENIDO PRINCIPAL (Figma Node 77:864)
             ============================================================== -->
        <div class="dash-main">
            <header class="dash-topbar">
                <div>
                    <div class="dash-topbar-title">Inventario</div>
                    <div class="dash-topbar-sub">Operación CALJIM · Paquisha, Ecuador</div>
                </div>

                <div class="dash-topbar-right">
                    <span class="dash-live-pill">
                        <span class="dash-live-dot"></span>
                        Base de datos MySQL activa
                    </span>

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="dash-logout-btn">Salir ↗</button>
                    </form>
                </div>
            </header>

            <main class="dash-content">
                <div class="dash-page-header">
                    <div>
                        <div class="dash-eyebrow">— CONTROL DE MATERIALES (RF-01 / RF-02)</div>
                        <h1 class="dash-h1">Inventario disponible</h1>
                        <p class="dash-sub">
                            @if($esAdmin)
                                Registra, actualiza las existencias en m³ y administra los precios referenciales por tipo de material.
                            @else
                                Consulta el stock en tiempo real y calcula el volumen en metros cúbicos (m³) para tu obra.
                            @endif
                        </p>
                    </div>

                    <div class="dash-header-actions">
                        <form action="{{ route('inventario.index') }}" method="GET" class="dash-search-form">
                            <input
                                type="text"
                                name="buscar"
                                value="{{ $buscar }}"
                                class="dash-search-input"
                                placeholder="Buscar por código o material..."
                            >
                            @if($buscar !== '')
                                <a href="{{ route('inventario.index') }}" class="btn-inv-edit" style="text-decoration:none;">Limpiar</a>
                            @endif
                        </form>

                        @if($esAdmin)
                            <button type="button" class="btn-dash-primary" onclick="abrirModalCrear()">
                                + Agregar material
                            </button>
                        @endif
                    </div>
                </div>

                @if(session('exito'))
                    <div class="dash-alert-ok">{{ session('exito') }}</div>
                @endif

                @if($errors->any())
                    <div class="auth-alert-error" style="margin-top:0;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- TABLA DE MATERIALES EN STOCK -->
                <section class="inv-card">
                    <div class="inv-card-top">
                        <h2 class="inv-card-title">Materiales en stock</h2>
                        <span class="inv-count">{{ $materiales->count() }} {{ $materiales->count() === 1 ? 'producto' : 'productos' }}</span>
                    </div>

                    <div class="inv-table-wrap">
                        <table class="inv-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Material</th>
                                    <th>Existencia</th>
                                    <th>Precio ref. / m³</th>
                                    <th>Disponibilidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materiales as $mat)
                                    <tr>
                                        <td><span class="inv-code">{{ $mat->codigo }}</span></td>
                                        <td>
                                            <strong>{{ $mat->nombre }}</strong>
                                            @if($mat->descripcion)
                                                <div style="font-size:10px; color:#7b8799; margin-top:2px;">{{ $mat->descripcion }}</div>
                                            @endif
                                        </td>
                                        <td><strong>{{ number_format($mat->stock_m3, 2) }} m³</strong></td>
                                        <td>${{ number_format($mat->precio_m3, 2) }}</td>
                                        <td>
                                            @if(!$mat->disponible || $mat->stock_m3 <= 0)
                                                <span class="inv-badge out">● Agotado</span>
                                            @elseif($mat->stock_m3 <= $mat->stock_minimo_m3)
                                                <span class="inv-badge low">● Stock bajo</span>
                                            @else
                                                <span class="inv-badge ok">● Disponible</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="inv-actions">
                                                @if($esAdmin)
                                                    <button
                                                        type="button"
                                                        class="btn-inv-edit"
                                                        onclick='abrirModalEditar(@json($mat))'
                                                    >
                                                        Editar
                                                    </button>

                                                    <form action="{{ route('inventario.destroy', $mat) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar {{ $mat->nombre }} del inventario?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-inv-del">Eliminar</button>
                                                    </form>
                                                @else
                                                    <button
                                                        type="button"
                                                        class="btn-inv-edit"
                                                        onclick="seleccionarEnCalculadora('{{ $mat->id }}')"
                                                    >
                                                        Calcular m³
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center; color:#7b8799; padding:32px;">
                                            No se encontraron materiales con ese criterio de búsqueda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- CALCULADORA DE VOLUMEN EN METROS CÚBICOS (RF-02) -->
                <section class="inv-card" id="calculadora">
                    <div class="inv-card-top" style="margin-bottom:6px;">
                        <h2 class="inv-card-title">Calculadora de volumen en metros cúbicos (m³) — RF-02</h2>
                        <span class="inv-count">Cálculo automático con IVA (15%)</span>
                    </div>
                    <p class="dash-sub">Selecciona un material disponible e indica el volumen en m³ requerido para estimar el costo total.</p>

                    <div class="calc-grid">
                        <div class="auth-field">
                            <label for="calc_material" class="auth-label">Material árido</label>
                            <select id="calc_material" class="mat-input" onchange="calcularPresupuesto()">
                                @foreach($materiales as $mat)
                                    <option
                                        value="{{ $mat->id }}"
                                        data-precio="{{ $mat->precio_m3 }}"
                                        data-stock="{{ $mat->stock_m3 }}"
                                    >
                                        {{ $mat->nombre }} (${{ number_format($mat->precio_m3, 2) }}/m³)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="auth-field">
                            <label for="calc_volumen" class="auth-label">Volumen requerido (m³)</label>
                            <input
                                type="number"
                                id="calc_volumen"
                                class="mat-input"
                                value="10"
                                min="0.5"
                                step="0.5"
                                oninput="calcularPresupuesto()"
                            >
                        </div>
                    </div>

                    <div class="calc-result-box">
                        <div class="calc-metric">
                            <span>Precio unitario / m³</span>
                            <strong id="resUnitario">$0.00</strong>
                        </div>
                        <div class="calc-metric">
                            <span>Subtotal material</span>
                            <strong id="resSubtotal">$0.00</strong>
                        </div>
                        <div class="calc-metric">
                            <span>IVA (15%)</span>
                            <strong id="resIva">$0.00</strong>
                        </div>
                        <div class="calc-metric total">
                            <span>Total estimado</span>
                            <strong id="resTotal">$0.00</strong>
                        </div>
                    </div>
                </section>

                <div class="inv-notice-bar">
                    Las existencias mostradas se consultan en tiempo real desde la tabla <strong>materiales</strong> de MySQL (<code>caljim_db</code>). Control de acceso RBAC activo: solo el rol <strong>Administrador</strong> puede crear, editar o eliminar materiales.
                </div>
            </main>
        </div>
    </div>

    @if($esAdmin)
        <!-- ==============================================================
             MODAL AGREGAR / EDITAR MATERIAL (Figma Node 169:4487)
             ============================================================== -->
        <div id="matModalBackdrop" class="auth-modal-backdrop hidden">
            <div class="mat-modal-card" data-node-id="169:4487">
                <div class="auth-header">
                    <div>
                        <h2 class="mat-modal-title" id="matModalTitle">Agregar material</h2>
                        <p class="mat-modal-sub">Actualiza stock y precio de referencia en la base de datos.</p>
                    </div>
                    <button type="button" class="auth-close-btn" onclick="cerrarModalMaterial()" title="Cerrar">×</button>
                </div>

                <form id="matForm" action="{{ route('inventario.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="matFormMethod" value="POST">

                    <div class="mat-form-grid">
                        <div class="auth-field">
                            <label for="mat_codigo" class="auth-label">Código</label>
                            <input type="text" id="mat_codigo" name="codigo" class="mat-input" placeholder="Ej. MAT-07" required>
                        </div>

                        <div class="auth-field">
                            <label for="mat_nombre" class="auth-label">Nombre</label>
                            <input type="text" id="mat_nombre" name="nombre" class="mat-input" placeholder="Ej. Arena fina" required>
                        </div>

                        <div class="auth-field">
                            <label for="mat_stock" class="auth-label">Existencia (m³)</label>
                            <input type="number" id="mat_stock" name="stock_m3" class="mat-input" value="0" min="0" step="0.01" required>
                        </div>

                        <div class="auth-field">
                            <label for="mat_precio" class="auth-label">Precio referencial ($ / m³)</label>
                            <input type="number" id="mat_precio" name="precio_m3" class="mat-input" value="0" min="0.01" step="0.01" required>
                        </div>

                        <div class="auth-field">
                            <label for="mat_minimo" class="auth-label">Stock mínimo alerta (m³)</label>
                            <input type="number" id="mat_minimo" name="stock_minimo_m3" class="mat-input" value="10" min="0" step="0.01">
                        </div>

                        <div class="auth-field">
                            <label for="mat_desc" class="auth-label">Descripción (opcional)</label>
                            <input type="text" id="mat_desc" name="descripcion" class="mat-input" placeholder="Uso recomendado del material">
                        </div>
                    </div>

                    <label class="mat-check-row">
                        <input type="checkbox" id="mat_disponible" name="disponible" value="1" checked>
                        <span>Material disponible para pedidos</span>
                    </label>

                    <p class="auth-terms" style="padding-top:12px;">
                        Los cambios se guardan directamente en MySQL y actualizan la disponibilidad en la página pública.
                    </p>

                    <button type="submit" class="auth-submit-btn" style="height:48px; margin-top:16px;">
                        Guardar material
                    </button>
                </form>
            </div>
        </div>
    @endif

    <script>
        function calcularPresupuesto() {
            const select = document.getElementById('calc_material');
            const volInput = document.getElementById('calc_volumen');
            if (!select || select.options.length === 0) return;

            const opcion = select.options[select.selectedIndex];
            const precio = parseFloat(opcion.getAttribute('data-precio')) || 0;
            const volumen = Math.max(0, parseFloat(volInput.value) || 0);

            const subtotal = precio * volumen;
            const iva = subtotal * 0.15;
            const total = subtotal + iva;

            document.getElementById('resUnitario').textContent = '$' + precio.toFixed(2);
            document.getElementById('resSubtotal').textContent = '$' + subtotal.toFixed(2);
            document.getElementById('resIva').textContent = '$' + iva.toFixed(2);
            document.getElementById('resTotal').textContent = '$' + total.toFixed(2);
        }

        function seleccionarEnCalculadora(id) {
            const select = document.getElementById('calc_material');
            select.value = id;
            calcularPresupuesto();
            document.getElementById('calculadora').scrollIntoView({ behavior: 'smooth' });
        }

        function abrirModalCrear() {
            document.getElementById('matModalTitle').textContent = 'Agregar material';
            document.getElementById('matForm').action = "{{ route('inventario.store') }}";
            document.getElementById('matFormMethod').value = 'POST';
            document.getElementById('mat_codigo').value = '';
            document.getElementById('mat_nombre').value = '';
            document.getElementById('mat_stock').value = '0';
            document.getElementById('mat_precio').value = '0';
            document.getElementById('mat_minimo').value = '10';
            document.getElementById('mat_desc').value = '';
            document.getElementById('mat_disponible').checked = true;
            document.getElementById('matModalBackdrop').classList.remove('hidden');
        }

        function abrirModalEditar(mat) {
            document.getElementById('matModalTitle').textContent = 'Editar material';
            document.getElementById('matForm').action = "{{ url('/inventario') }}/" + mat.id;
            document.getElementById('matFormMethod').value = 'PUT';
            document.getElementById('mat_codigo').value = mat.codigo;
            document.getElementById('mat_nombre').value = mat.nombre;
            document.getElementById('mat_stock').value = mat.stock_m3;
            document.getElementById('mat_precio').value = mat.precio_m3;
            document.getElementById('mat_minimo').value = mat.stock_minimo_m3;
            document.getElementById('mat_desc').value = mat.descripcion || '';
            document.getElementById('mat_disponible').checked = Boolean(mat.disponible);
            document.getElementById('matModalBackdrop').classList.remove('hidden');
        }

        function cerrarModalMaterial() {
            document.getElementById('matModalBackdrop').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', calcularPresupuesto);
    </script>
</body>
</html>

