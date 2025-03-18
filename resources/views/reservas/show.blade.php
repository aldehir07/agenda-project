<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Show Page</title>
</head>
<body>
    @include('plantilla.nabvar')
    <div class="container">
        <h1>Detalle de la Reserva</h1>

        <table class="table">
            <tr><th>Fecha:</th><td>{{ $reserva->fecha }}</td></tr>
            <tr><th>Turno:</th><td>{{ $reserva->turno }}</td></tr>
            <tr><th>Salón:</th><td>{{ $reserva->salon->nombre }}</td></tr>
            <tr><th>Tema:</th><td>{{ $reserva->tema }}</td></tr>
            <tr><th>Analista:</th><td>{{ $reserva->analista }}</td></tr>
        </table>

        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Volver</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
