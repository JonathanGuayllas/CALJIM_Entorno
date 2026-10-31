<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante CALJIM — Hola Mundo PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #0f172a; font-size: 12px; }
        .header { border-bottom: 2px solid #059669; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; color: #059669; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
        th { background: #ecfdf5; color: #065f46; }
        .footer { margin-top: 25px; font-size: 10px; color: #64748b; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">CALJIM — Comprobante Electrónico de Prueba (DomPDF)</div>
        <div>Fecha de emisión: {{ $fecha }} | Arquitectura: PHP 8 + Laravel 11 MVC</div>
    </div>

    <p>Este documento PDF fue generado dinámicamente con la librería <strong>DomPDF</strong> integrada en el controlador MVC de CALJIM (RF-11).</p>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Material Árido</th>
                <th>Precio / m³</th>
                <th>Stock Disponible</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiales as $item)
                <tr>
                    <td>{{ $item['codigo'] }}</td>
                    <td>{{ $item['nombre'] }}</td>
                    <td>${{ number_format($item['precio_m3'], 2) }}</td>
                    <td>{{ $item['stock_m3'] }} m³</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Equipo CALJIM: Jonathan Guayllas &bull; Fabian Cañar &bull; Alfonso Ocampo
    </div>
</body>
</html>

