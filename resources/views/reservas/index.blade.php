<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Title</title>
</head>
<body>
    @include('plantilla.nabvar')
    <div class="container">
        <h1 class="mb-4">Listado de Reservas</h1>

        <a href="{{ route('reservas.create') }}" class="btn btn-primary mb-3">Nueva Reserva</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Turno</th>
                    <th>Salón</th>
                    <th>Tema</th>
                    <th>Analista</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->turno }}</td>
                    <td>{{ $reserva->salon->nombre }}</td>
                    <td>{{ $reserva->tema }}</td>
                    <td>{{ $reserva->analista }}</td>
                    <td>
                        <a href="{{ route('reservas.show', $reserva) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
