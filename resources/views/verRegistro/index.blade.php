<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Ver Informacion</title>
</head>

<body>
    @include('plantilla.nabvar')
    <h1 class="text-center my-4">Información General</h1>

    <!-- Selector para cambiar la vista -->
<div class="mb-3 text-center">
    <label for="viewSelector" class="form-label fw-bold">Seleccionar Vista:</label>
    <select id="viewSelector" class="form-select w-auto d-inline-block">
        <option value="general">Vista General</option>
        <option value="soporte">Soporte Técnico</option>
        <option value="insumos">Insumos</option>
    </select>
</div>

<div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col" data-column="id">ID</th>
                <th scope="col" data-column="fecha">Fecha</th>
                <th scope="col" data-column="salon">Salón</th>
                <th scope="col" data-column="duracion">Duración</th>
                <th scope="col" data-column="actividad">Actividad</th>
                <th scope="col" data-column="analista">Analista</th>
                <th scope="col" data-column="depto">Depto. Responsable</th>
                <th scope="col" data-column="evento">N° Evento</th>
                <th scope="col" data-column="scafid">Scafid</th>
                <th scope="col" data-column="mes">Mes</th>
                <th scope="col" data-column="inicio">Fecha Inicio</th>
                <th scope="col" data-column="final">Fecha Final</th>
                <th scope="col" data-column="tipo">Tipo Actividad</th>
                <th scope="col" data-column="receso_am">Receso A.M</th>
                <th scope="col" data-column="receso_pm">Receso P.M</th>
                <th scope="col" data-column="publico">Público Meta</th>
                <th scope="col" data-column="participantes">Participantes</th>
                <th scope="col" data-column="facilitador">Facilitador</th>
                <th scope="col" data-column="estatus">Estatus</th>
                <th scope="col" data-column="montaje">Montaje</th>
                <th scope="col" data-column="insumos">Insumos</th>
                <th scope="col" data-column="requisitos">Requisitos Técnicos</th>
                <th scope="col" data-column="asistencia">Asistencia Técnica</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($reservas as $reserva)
                <tr>
                    <th scope="row" data-column="id">{{ $reserva->id }}</th>
                    <td data-column="fecha">{{ $reserva->fecha }}</td>
                    <td data-column="salon">{{ $reserva->salon }}</td>
                    <td data-column="duracion">
                        {{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('g:i A') }} -
                        {{ \Carbon\Carbon::parse($reserva->hora_fin)->format('g:i A') }}
                    </td>
                    <td data-column="actividad">{{ $reserva->actividad }}</td>
                    <td data-column="analista">{{ $reserva->analista }}</td>
                    <td data-column="depto">{{ $reserva->depto_responsable }}</td>
                    <td data-column="evento">{{ $reserva->numero_evento }}</td>
                    <td data-column="scafid">{{ $reserva->scafid }}</td>
                    <td data-column="mes">{{ $reserva->mes }}</td>
                    <td data-column="inicio">{{ \Carbon\Carbon::parse($reserva->fecha_inicio)->translatedFormat('D, d M') }}</td>
                    <td data-column="final">{{ \Carbon\Carbon::parse($reserva->fecha_final)->translatedFormat('D, d M') }}</td>
                    <td data-column="tipo">{{ $reserva->tipo_actividad }}</td>
                    <td data-column="receso_am">{{ \Carbon\Carbon::parse($reserva->receso_am)->format('g:i A') }}</td>
                    <td data-column="receso_pm">{{ \Carbon\Carbon::parse($reserva->receso_pm)->format('g:i A') }}</td>
                    <td data-column="publico">{{ $reserva->publico_meta }}</td>
                    <td data-column="participantes">{{ $reserva->cant_participantes }}</td>
                    <td data-column="facilitador">{{ $reserva->facilitador_moderador }}</td>
                    <td data-column="estatus"><span class="badge bg-success">{{ $reserva->estatus }}</span></td>
                    <td data-column="montaje">{{ $reserva->montaje ?? 'N/A' }}</td>
                    <td data-column="insumos">{{ $reserva->insumos }}</td>
                    <td data-column="requisitos">{{ $reserva->requisitos_tecnicos }}</td>
                    <td data-column="asistencia">{{ $reserva->asistencia_tecnica }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.getElementById("viewSelector").addEventListener("change", function () {
    let selectedView = this.value;
    let allColumns = document.querySelectorAll("[data-column]");

    allColumns.forEach(col => col.style.display = "none"); // Ocultar todo por defecto

    if (selectedView === "general") {
        allColumns.forEach(col => col.style.display = "table-cell"); // Mostrar todo
    } else if (selectedView === "soporte") {
        let soporteColumns = ["salon", "inicio", "final", "actividad", "duracion", "analista", "estatus", "montaje", "requisitos", "asistencia"];
        soporteColumns.forEach(col => {
            document.querySelectorAll(`[data-column="${col}"]`).forEach(el => el.style.display = "table-cell");
        });
    } else if (selectedView === "insumos") {
        let insumosColumns = ["salon", "inicio", "final", "actividad", "duracion", "estatus", "receso_am", "receso_pm", "participantes", "insumos"];
        insumosColumns.forEach(col => {
            document.querySelectorAll(`[data-column="${col}"]`).forEach(el => el.style.display = "table-cell");
        });
    }
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>
