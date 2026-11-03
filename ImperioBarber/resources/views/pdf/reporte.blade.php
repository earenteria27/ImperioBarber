<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicios</title>
    <style>
        body { font-family: sans-serif; margin: 30px; color: #333; }
        h1 { color: #e11d48; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 14px; }
        th { background-color: #f4f4f4; }
        .fecha { text-align: right; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="fecha">Fecha de emisión: {{ $fecha }}</div>
    <h1>{{ $titulo }}</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Duración (min)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->nombre }}</td>
                    <td>{{ $servicio->descripcion }}</td>
                    <td>${{ number_format($servicio->precio, 2) }}</td>
                    <td>{{ $servicio->duracion_minutos }} min</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>