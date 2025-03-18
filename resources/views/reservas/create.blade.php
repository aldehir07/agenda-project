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
        <h1 class="mb-4">Crear Nueva Reserva</h1>

        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="salon_id" class="form-label">Salón</label>
                <select name="salon_id" id="salon_id" class="form-control" required>
                    <option value="" disabled>Seleccione un salón</option>
                    @foreach($salones as $salon)
                        <option value="{{ $salon->id }}">{{ $salon->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="turno" class="form-label">Turno</label>
                <select name="turno" id="turno" class="form-control" required>
                    <option value="A.M.">A.M.</option>
                    <option value="P.M.">P.M.</option>
                    <option value="Completo">Completo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tema" class="form-label">Tema</label>
                <input type="text" name="tema" id="tema" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="analista" class="form-label">Analista/Encargado</label>
                <input type="text" name="analista" id="analista" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
