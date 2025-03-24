<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Calendario - Prueba</title>
</head>
<body>
    @include('plantilla.nabvar')
    <div class="container">
        <h2>Crear Reserva</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('reservaCal.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="{{ request('fecha') }}" required readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Depto. Responsable:</label>
            <select class="form-select" name="depto_responsable">
                <option value="Presencial">Presencial</option>
                <option value="A distancia">A distancia</option>
                <option value="Direccion">Direccion</option>
            </select>
            </div>

            <div class="mb-3">
                <label for="salon" class="form-label">Salón</label>
                <select name="salon" class="form-control" required>
                    <option value="" disabled selected>Selecciona un salón</option>
                    <option value="Auditorio Jorge L. Quijada">Auditorio Jorge L. Quijada</option>
                    <option value="Trabajo en Equipo">Trabajo en Equipo</option>
                    <option value="Comunicación Asertiva">Comunicación Asertiva</option>
                    <option value="Servicio al Cliente">Servicio al Cliente</option>
                    <option value="Integridad">Integridad</option>
                    <option value="Creatividad Innovadora">Creatividad Innovadora</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="actividad" class="form-label">Actividad</label>
                <textarea class="form-control" name="actividad" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Numero Evento:</label>
                <input type="number" name="numero_evento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Scafid:</label>
                <input class="form-control" type="text" name="scafid">
            </div>

            <div class="mb-3">
                <label class="form-label">Mes:</label>
                <select class="form-control" name="mes" required>
                    <option value="" disabled selected>Selecciona un mes</option>
                    <option value="Enero">Enero</option>
                    <option value="Febrero">Febrero</option>
                    <option value="Marzo">Marzo</option>
                    <option value="Abril">Abril</option>
                    <option value="Mayo">Mayo</option>
                    <option value="Junio">Junio</option>
                    <option value="Julio">Julio</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Septiembre">Septiembre</option>
                    <option value="Octubre">Octubre</option>
                    <option value="Noviembre">Noviembre</option>
                    <option value="Diciembre">Diciembre</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                <input type="time" class="form-control" name="hora_inicio" required>
            </div>

            <div class="mb-3">
                <label for="hora_fin" class="form-label">Hora de Fin</label>
                <input type="time" class="form-control" name="hora_fin" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Inicio:</label>
                <input class="form-control" type="date" name="fecha_inicio" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Final:</label>
                <input class="form-control" type="date" name="fecha_final" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Actividad:</label>
                <select class="form-control" name="tipo_actividad">
                    <option value="Reunion">Reunion</option>
                    <option value="Capacitacion">Capacitacion</option>
                    <option value="REPLICA">REPLICA</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Receso A.M:</label>
                <input class="form-control" type="time" name="receso_am">
            </div>

            <div class="mb-3">
                <label class="form-label">Receso P.M:</label>
                <input class="form-control" type="time" name="receso_pm">
            </div>

            <div class="mb-3">
                <label class="form-label">Publico Meta:</label>
                <input class="form-control" type="text" name="publico_meta" required>
            </div>

            <div class="mb-3">
                <label for="cant_participantes" class="form-label">Cant. de Participantes:</label>
                <input class="form-control" type="number" name="cant_participantes" min="1" required> <!-- Agregado min="1" -->
            </div>

            <div class="mb-3">
                <label class="form-label">Facilitador o Moderador:</label>
                <input class="form-control" type="text" name="facilitador_moderador" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estatus:</label>
                <select class="form-select" name="estatus">
                    <option value="Programado">Programado</option>
                    <option value="Cancelado">Cancelado</option>
                    <option value="Realizado">Realizado</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Insumos:</label>
                <textarea class="form-control"  name="insumos"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Requisitos Técnicos:</label>
                <textarea class="form-control" name="requisitos_tecnicos"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" >Asistencia Técnica:</label>
                <select class="form-control" name="asistencia_tecnica">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="analista" class="form-label">Analista</label>
                <input type="text" class="form-control" name="analista" required>
            </div>

            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
