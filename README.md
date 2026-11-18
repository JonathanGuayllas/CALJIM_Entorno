# Proyecto CALJIM

Plataforma web para la gestión de material pétreo, transporte y alquiler de maquinaria pesada en Paquisha, Zamora Chinchipe.

## Estado actual del proyecto (Avance 30%)
- **Entorno y arquitectura**: Configurado con **PHP 8** y **Laravel 11** bajo arquitectura **MVC** (Modelo–Vista–Controlador).
- **Base de datos**: Modelo relacional normalizado de **12 tablas** implementado en **MySQL / MariaDB** (`caljim_db`, motor InnoDB).
- **Autenticación y seguridad**:
  - Inicio de sesión y registro público exclusivo para clientes.
  - Contraseñas cifradas con **Bcrypt** (12 rondas), doble confirmación, requisitos de longitud y caracteres especiales, medidor visual de seguridad (*Débil / Media / Segura*) y validación de correo y teléfono únicos.
  - Verificación **CAPTCHA SVG** en el servidor, protección **Anti-CSRF** y recuperación de contraseña en 3 pasos (correo o celular).
- **Módulo 1 — Materiales e Inventario (`RF-01` y `RF-02`)**:
  - Control de acceso basado en roles (**RBAC**: Administrador, Operario y Cliente) con menús adaptados por perfil.
  - CRUD completo de materiales en stock conectado en tiempo real a MySQL (exclusivo para Administrador) y calculadora interactiva de volumen en $\text{m}^3$ con cálculo de IVA (15%).

*El proyecto continúa en desarrollo bajo metodología ágil Scrum para la implementación de los módulos de pedidos, maquinaria, nómina y facturación electrónica.*
