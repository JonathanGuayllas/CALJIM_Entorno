-- ============================================================================
-- SCRIPT DE BASE DE DATOS: PLATAFORMA OPERATIVA CALJIM (12 TABLAS - MODELO MVC)
-- Motor: InnoDB (Transacciones ACID - RNF-05) | Collation: utf8mb4_unicode_ci
-- ============================================================================

CREATE DATABASE IF NOT EXISTS caljim_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE caljim_db;

-- 1. TABLA USUARIOS (RBAC: Admin, Operario, Cliente - RNF-04)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(120) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'operario', 'cliente') NOT NULL DEFAULT 'cliente',
    cedula_ruc VARCHAR(20) NOT NULL,
    telefono VARCHAR(20) NULL,
    direccion VARCHAR(200) NULL,
    licencia_conducir VARCHAR(30) NULL COMMENT 'Solo para operarios/conductores',
    tarifa_hora DECIMAL(8,2) NULL COMMENT 'Tarifa base por hora para nomina de operarios (RF-09)',
    estado TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. TABLA MATERIALES (Módulo 1: Materiales e Inventario - RF-01, RF-02)
CREATE TABLE IF NOT EXISTS materiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    imagen_url VARCHAR(255) NULL,
    precio_m3 DECIMAL(10,2) NOT NULL,
    stock_m3 DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock_minimo_m3 DECIMAL(10,2) NOT NULL DEFAULT 10.00,
    disponible TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. TABLA MAQUINARIAS (Módulo 3: Maquinaria y Equipos - RF-06)
CREATE TABLE IF NOT EXISTS maquinarias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_placa VARCHAR(30) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('volqueta', 'excavadora', 'cargadora', 'retroexcavadora', 'rodillo') NOT NULL,
    marca_modelo VARCHAR(100) NULL,
    capacidad_m3 DECIMAL(8,2) NULL,
    tarifa_hora_alquiler DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    horometro_actual DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    proximo_mantenimiento_hrs DECIMAL(10,2) NOT NULL DEFAULT 250.00,
    estado ENUM('disponible', 'alquilado', 'en_ruta', 'en_mantenimiento') NOT NULL DEFAULT 'disponible',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 4. TABLA MANTENIMIENTOS (Módulo 3: Preventivo y Correctivo - RF-07)
CREATE TABLE IF NOT EXISTS mantenimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    maquinaria_id INT NOT NULL,
    responsable_id INT NOT NULL,
    tipo ENUM('preventivo', 'correctivo') NOT NULL,
    fecha_programada DATE NOT NULL,
    fecha_realizada DATE NULL,
    horometro_registro DECIMAL(10,2) NOT NULL,
    descripcion_trabajo TEXT NOT NULL,
    repuestos_utilizados TEXT NULL,
    costo_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    estado ENUM('pendiente', 'en_proceso', 'completado') NOT NULL DEFAULT 'pendiente',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_mant_maquinaria FOREIGN KEY (maquinaria_id) REFERENCES maquinarias(id) ON DELETE CASCADE,
    CONSTRAINT fk_mant_responsable FOREIGN KEY (responsable_id) REFERENCES usuarios(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 5. TABLA PEDIDOS (Módulo 2: Logística y Despacho Tripartito - RF-03)
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_pedido VARCHAR(30) NOT NULL UNIQUE,
    cliente_id INT NOT NULL,
    operario_id INT NULL COMMENT 'Conductor asignado al despacho',
    maquinaria_transporte_id INT NULL COMMENT 'Volqueta asignada al despacho',
    fecha_pedido DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_entrega_estimada DATETIME NULL,
    direccion_entrega VARCHAR(255) NOT NULL,
    latitud_destino DECIMAL(10,7) NULL,
    longitud_destino DECIMAL(10,7) NULL,
    costo_flete DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    estado ENUM('solicitado', 'confirmado', 'cargado', 'en_transito', 'entregado', 'cancelado') NOT NULL DEFAULT 'solicitado',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_pedido_cliente FOREIGN KEY (cliente_id) REFERENCES usuarios(id) ON DELETE RESTRICT,
    CONSTRAINT fk_pedido_operario FOREIGN KEY (operario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    CONSTRAINT fk_pedido_transporte FOREIGN KEY (maquinaria_transporte_id) REFERENCES maquinarias(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 6. TABLA DETALLE_PEDIDO_MATERIALES (Áridos en m3 por Pedido - RF-02)
CREATE TABLE IF NOT EXISTS detalle_pedido_materiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    material_id INT NOT NULL,
    volumen_m3 DECIMAL(10,2) NOT NULL,
    precio_unitario_m3 DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_dpm_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    CONSTRAINT fk_dpm_material FOREIGN KEY (material_id) REFERENCES materiales(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 7. TABLA DETALLE_PEDIDO_MAQUINARIAS (Alquiler de Maquinaria en Pedido - RF-06, RF-11)
CREATE TABLE IF NOT EXISTS detalle_pedido_maquinarias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    maquinaria_id INT NOT NULL,
    operario_asignado_id INT NULL,
    horas_alquiler DECIMAL(8,2) NOT NULL,
    tarifa_hora DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_dpmaq_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    CONSTRAINT fk_dpmaq_maquinaria FOREIGN KEY (maquinaria_id) REFERENCES maquinarias(id) ON DELETE RESTRICT,
    CONSTRAINT fk_dpmaq_operario FOREIGN KEY (operario_asignado_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 8. TABLA UBICACIONES_GPS (Rastreo en Vivo y Trazabilidad de Rutas - RF-04, RF-05)
CREATE TABLE IF NOT EXISTS ubicaciones_gps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NULL,
    maquinaria_id INT NOT NULL,
    operario_id INT NOT NULL,
    latitud DECIMAL(10,7) NOT NULL,
    longitud DECIMAL(10,7) NOT NULL,
    velocidad_kmh DECIMAL(6,2) NOT NULL DEFAULT 0.00,
    en_parada TINYINT(1) NOT NULL DEFAULT 0,
    fecha_hora_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_gps_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE SET NULL,
    CONSTRAINT fk_gps_maquinaria FOREIGN KEY (maquinaria_id) REFERENCES maquinarias(id) ON DELETE CASCADE,
    CONSTRAINT fk_gps_operario FOREIGN KEY (operario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 9. TABLA FACTURAS (Facturación Electrónica DomPDF y Finanzas - RF-11, RF-12)
CREATE TABLE IF NOT EXISTS facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_factura VARCHAR(40) NOT NULL UNIQUE,
    pedido_id INT NOT NULL UNIQUE,
    fecha_emision DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    subtotal_materiales DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    subtotal_maquinaria DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    costo_flete DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    porcentaje_iva DECIMAL(5,2) NOT NULL DEFAULT 15.00,
    monto_iva DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total_pagar DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    pdf_url VARCHAR(255) NULL,
    estado_pago ENUM('pendiente', 'pagada', 'anulada') NOT NULL DEFAULT 'pendiente',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_factura_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 10. TABLA JORNADAS_LABORALES (Registro Digital de Horas - RF-08)
CREATE TABLE IF NOT EXISTS jornadas_laborales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    operario_id INT NOT NULL,
    pedido_id INT NULL COMMENT 'Orden de trabajo vinculada en campo',
    fecha DATE NOT NULL,
    hora_entrada TIME NOT NULL,
    hora_salida TIME NULL,
    horas_normales DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    horas_extra DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    observaciones VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_jornada_operario FOREIGN KEY (operario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_jornada_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 11. TABLA LIQUIDACIONES_NOMINA (Liquidación Automatizada de Pagos - RF-09)
CREATE TABLE IF NOT EXISTS liquidaciones_nomina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    operario_id INT NOT NULL,
    periodo_inicio DATE NOT NULL,
    periodo_fin DATE NOT NULL,
    total_horas_normales DECIMAL(6,2) NOT NULL DEFAULT 0.00,
    total_horas_extra DECIMAL(6,2) NOT NULL DEFAULT 0.00,
    monto_horas_normales DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    monto_horas_extra DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    deducciones DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    neto_pagar DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    fecha_pago DATE NULL,
    comprobante_pdf_url VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_nomina_operario FOREIGN KEY (operario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 12. TABLA MENSAJES_INTERNOS (Canal de Comunicación Operativa - RF-10)
CREATE TABLE IF NOT EXISTS mensajes_internos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remitente_id INT NOT NULL,
    destinatario_id INT NOT NULL,
    pedido_id INT NULL,
    tipo ENUM('tarea', 'cambio_ruta', 'incidencia_mecanica', 'general') NOT NULL DEFAULT 'general',
    asunto VARCHAR(150) NOT NULL,
    contenido TEXT NOT NULL,
    leido TINYINT(1) NOT NULL DEFAULT 0,
    fecha_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_msg_remitente FOREIGN KEY (remitente_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_msg_destinatario FOREIGN KEY (destinatario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_msg_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE SET NULL
) ENGINE=InnoDB;

