<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Edit Page</title>
</head>
<body>
    @include('plantilla.nabvar')
    <div class="container">
        <h1>Editar Reserva</h1>

        <form action="{{ route('reservas.update', $reserva) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="salon_id" class="form-label">Salón</label>
                <select name="salon_id" id="salon_id" class="form-control" required>
                    @foreach($salones as $salon)
                        <option value="{{ $salon->id }}" {{ $salon->id == $reserva->salon_id ? 'selected' : '' }}>{{ $salon->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $reserva->fecha }}" required>
            </div>

            <div class="mb-3">
                <label for="turno" class="form-label">Turno</label>
                <select name="turno" id="turno" class="form-control" required>
                    <option value="A.M." {{ $reserva->turno == 'A.M.' ? 'selected' : '' }}>A.M.</option>
                    <option value="P.M." {{ $reserva->turno == 'P.M.' ? 'selected' : '' }}>P.M.</option>
                    <option value="Completo" {{ $reserva->turno == 'Completo' ? 'selected' : '' }}>Completo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tema" class="form-label">Tema</label>
                <input type="text" name="tema" id="tema" class="form-control" value="{{ $reserva->tema }}" required>
            </div>

            <div class="mb-3">
                <label for="analista" class="form-label">Analista</label>
                <input type="text" name="analista" id="analista" class="form-control" value="{{ $reserva->analista }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
