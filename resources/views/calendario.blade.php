<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Calendario - Prueba</title>
</head>

<body>
    @include('plantilla.nabvar')
    <div class="container">

        <h2>Calendario de Reservas</h2>
        {{-- MENSAJES DE ERROR Y ÉXITO --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- {{ dd(session()->all()) }} --}}
        <form method="GET" action="{{ route('calendario') }}"
            class="mb-4 d-flex align-items-center justify-content-center gap-3 bg-light p-3 rounded shadow">
            <label for="mes" class="form-label fw-bold mb-0">📅 Seleccionar mes:</label>
            <select name="mes" id="mes" class="form-select w-auto" onchange="this.form.submit()">
                @php
                    setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'Spanish'); // Configura el idioma a español
                    $mesActual = request('mes', now()->format('m'));
                @endphp
                @foreach (range(1, 12) as $m)
                    <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ $m == $mesActual ? 'selected' : '' }}>
                        {{ ucfirst(strftime('%B', mktime(0, 0, 0, $m, 1))) }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="calendar">
            @php
                $mesSeleccionado = request('mes', now()->format('m'));
                $anioActual = now()->format('Y');
                $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mesSeleccionado, $anioActual);
            @endphp
            @for ($i = 1; $i <= $diasEnMes; $i++)
                @php
                    $fecha =
                        $anioActual .
                        '-' .
                        str_pad($mesSeleccionado, 2, '0', STR_PAD_LEFT) .
                        '-' .
                        str_pad($i, 2, '0', STR_PAD_LEFT);
                    $reservasDia = $reservaCals->where('fecha', $fecha);

                    $conflicto = false;
                    foreach ($reservasDia as $reserva1) {
                        foreach ($reservasDia as $reserva2) {
                            if (
                                $reserva1->id !== $reserva2->id &&
                                (($reserva1->hora_inicio >= $reserva2->hora_inicio &&
                                    $reserva1->hora_inicio < $reserva2->hora_fin) ||
                                    ($reserva1->hora_fin > $reserva2->hora_inicio &&
                                        $reserva1->hora_fin <= $reserva2->hora_fin) ||
                                    ($reserva1->hora_inicio <= $reserva2->hora_inicio &&
                                        $reserva1->hora_fin >= $reserva2->hora_fin))
                            ) {
                                $conflicto = true;
                                break 2; // Salir del bucle si hay un conflicto
                            }
                        }
                    }
                @endphp

                <div class="calendar__day {{ $conflicto ? 'bg-danger text-white' : '' }}">
                    <a href="{{ route('reservaCal.create', ['fecha' => $fecha]) }}">
                        <span class="calendar__date">{{ $i }}</span>
                    </a>

                    @foreach ($reservasDia as $reserva)
                        <div class="calendar__task">
                            <strong>{{ $reserva->salon }}</strong> <br>
                            {{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('g:i A') }}
                             -
                            {{ \Carbon\Carbon::parse($reserva->hora_fin)->format('g:i A') }} <br>
                            <em>{{ $reserva->actividad }}</em> <br>
                            Analista: {{ $reserva->analista }} <br>
                        </div>
                    @endforeach

                    @if ($conflicto)
                        <div class="alert alert-warning p-1 mt-2">
                            ⚠️ Conflicto de horario en este día.
                        </div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .calendar__day {
            border: 1px solid #ddd;
            padding: 10px;
            min-height: 100px;
        }

        .calendar__date {
            font-weight: bold;
            display: block;
            text-align: center;
            margin-bottom: 5px;
        }

        .calendar__task {
            background-color: #f8f9fa;
            color: black;
            padding: 5px;
            margin-top: 5px;
            border-radius: 5px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>
