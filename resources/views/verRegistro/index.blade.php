<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <title>Ver Informacion</title>
</head>

<body>
    @include('plantilla.nabvar')
    <div class="container-fluid px-4">
        <h1 class="text-center my-4">Información General</h1>

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Registros de Reservas
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm" id="exportExcel">
                            <i class="fas fa-file-excel"></i> Excel
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" id="exportPDF">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="registrosTable" class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Salón</th>
                                <th>Duración</th>
                                <th>Actividad</th>
                                <th>Analista</th>
                                <th>Depto.</th>
                                <th>N° Evento</th>
                                <th>Scafid</th>
                                <th>Mes</th>
                                <th>Inicio</th>
                                <th>Final</th>
                                <th>Tipo</th>
                                <th>Receso AM</th>
                                <th>Receso PM</th>
                                <th>Participantes</th>
                                <th>Estatus</th>
                                <th>Requisitos</th>
                                <th>Insumos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->id }}</td>
                                    <td>{{ $reserva->fecha }}</td>
                                    <td>{{ $reserva->salon }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($reserva->hora_fin)->format('g:i A') }}
                                    </td>
                                    <td>{{ $reserva->actividad }}</td>
                                    <td>{{ $reserva->analista }}</td>
                                    <td>{{ $reserva->depto_responsable }}</td>
                                    <td>{{ $reserva->numero_evento }}</td>
                                    <td>{{ $reserva->scafid }}</td>
                                    <td>{{ $reserva->mes }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_final)->format('d/m/Y') }}</td>
                                    <td>{{ $reserva->tipo_actividad }}</td>
                                    <td>
                                        @if($reserva->receso_am)
                                            {{ \Carbon\Carbon::parse($reserva->receso_am)->format('g:i A') }}
                                            <small class="text-muted">(15 min)</small>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($reserva->receso_pm)
                                            {{ \Carbon\Carbon::parse($reserva->receso_pm)->format('g:i A') }}
                                            <small class="text-muted">(15 min)</small>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $reserva->cant_participantes }}</td>
                                    <td>
                                        @php
                                            $estatusClass = [
                                                'Programado' => 'bg-primary',
                                                'Realizado' => 'bg-success',
                                                'Cancelado' => 'bg-danger'
                                            ][$reserva->estatus] ?? 'bg-secondary';
                                            
                                            $estatusIcon = [
                                                'Programado' => 'calendar-check',
                                                'Realizado' => 'check-circle',
                                                'Cancelado' => 'times-circle'
                                            ][$reserva->estatus] ?? 'question-circle';
                                        @endphp
                                        <span class="badge {{ $estatusClass }} d-flex align-items-center" 
                                              style="font-size: 0.9em; padding: 8px;">
                                            <i class="fas fa-{{ $estatusIcon }} me-2"></i>
                                            {{ $reserva->estatus }}
                                        </span>
                                    </td>
                                    <td>{{ $reserva->requisitos_tecnicos }}</td>
                                    <td>{{ $reserva->insumos }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    onclick="mostrarDetalles({{ $reserva->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if($reserva->estatus != 'Realizado')
                                                <button type="button" class="btn btn-sm btn-success" 
                                                        onclick="cambiarEstatus({{ $reserva->id }}, '{{ $reserva->estatus }}')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Detalles -->
    <div class="modal fade" id="detallesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de la Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Salón:</strong> <span id="modalSalon"></span></p>
                            <p><strong>Actividad:</strong> <span id="modalActividad"></span></p>
                            <p><strong>Fecha:</strong> <span id="modalFecha"></span></p>
                            <p><strong>Horario:</strong> <span id="modalHorario"></span></p>
                            <p><strong>Analista:</strong> <span id="modalAnalista"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Departamento:</strong> <span id="modalDepto"></span></p>
                            <p><strong>Participantes:</strong> <span id="modalParticipantes"></span></p>
                            <p><strong>Insumos:</strong> <span id="modalInsumos"></span></p>
                            <p><strong>Requisitos Técnicos:</strong> <span id="modalRequisitos"></span></p>
                            <p><strong>Asistencia Técnica:</strong> <span id="modalAsistencia"></span></p>
                            <p><strong>Receso AM:</strong> <span id="modalRecesoAM"></span></p>
                            <p><strong>Receso PM:</strong> <span id="modalRecesoPM"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Cambio de Estatus -->
    <div class="modal fade" id="estatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Estatus de Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cambioEstatusForm">
                        @csrf
                        <input type="hidden" id="reserva_id" name="reserva_id">
                        <div class="mb-4">
                            <label for="estatus" class="form-label">Nuevo Estatus</label>
                            <div class="d-flex gap-2">
                                <div class="form-check flex-fill">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatusProgramado" value="Programado">
                                    <label class="form-check-label p-2 rounded border w-100 text-center" for="estatusProgramado">
                                        <i class="fas fa-calendar-check text-primary mb-2 d-block" style="font-size: 1.5em;"></i>
                                        Programado
                                    </label>
                                </div>
                                <div class="form-check flex-fill">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatusRealizado" value="Realizado">
                                    <label class="form-check-label p-2 rounded border w-100 text-center" for="estatusRealizado">
                                        <i class="fas fa-check-circle text-success mb-2 d-block" style="font-size: 1.5em;"></i>
                                        Realizado
                                    </label>
                                </div>
                                <div class="form-check flex-fill">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatusCancelado" value="Cancelado">
                                    <label class="form-check-label p-2 rounded border w-100 text-center" for="estatusCancelado">
                                        <i class="fas fa-times-circle text-danger mb-2 d-block" style="font-size: 1.5em;"></i>
                                        Cancelado
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">
                                <i class="fas fa-comment-alt me-1"></i>
                                Observaciones
                            </label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" 
                                    placeholder="Ingrese cualquier observación relevante sobre el cambio de estatus..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCambioEstatus()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://kit.fontawesome.com/your-code.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            var table = $('#registrosTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                },
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-success btn-sm',
                        text: '<i class="fas fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger btn-sm',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    }
                ],
                order: [[0, 'desc']]
            });

            // Manejador para el modal de detalles
            $('.ver-detalles').click(function() {
                var reserva = JSON.parse($(this).data('reserva'));
                $('#modalSalon').text(reserva.salon);
                $('#modalActividad').text(reserva.actividad);
                $('#modalFecha').text(reserva.fecha);
                $('#modalHorario').text(reserva.hora_inicio + ' - ' + reserva.hora_fin);
                $('#modalAnalista').text(reserva.analista);
                $('#modalDepto').text(reserva.depto_responsable);
                $('#modalParticipantes').text(reserva.cant_participantes);
                $('#modalInsumos').text(reserva.insumos || 'No especificado');
                $('#modalRequisitos').text(reserva.requisitos_tecnicos || 'No especificado');
                $('#modalAsistencia').text(reserva.asistencia_tecnica);
                
                // Formatear recesos
                const recesoAM = reserva.receso_am ? 
                    moment(reserva.receso_am, 'HH:mm:ss').format('h:mm A') + ' (15 min)' : 
                    'No programado';
                const recesoPM = reserva.receso_pm ? 
                    moment(reserva.receso_pm, 'HH:mm:ss').format('h:mm A') + ' (15 min)' : 
                    'No programado';
                $('#modalRecesoAM').text(recesoAM);
                $('#modalRecesoPM').text(recesoPM);
            });

            // Manejador para eliminar registro
            $('.eliminar-registro').click(function() {
                if (confirm('¿Está seguro de que desea eliminar este registro?')) {
                    var id = $(this).data('id');
                    // Aquí iría la lógica para eliminar el registro
                    // Por ejemplo, una llamada AJAX al servidor
                }
            });

            // Tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        function cambiarEstatus(id, estatusActual) {
            $('#reserva_id').val(id);
            $(`#estatus${estatusActual}`).prop('checked', true);
            $('#observaciones').val('');

            // Resaltar la opción seleccionada
            $('.form-check-label').removeClass('border-primary border-2');
            $(`#estatus${estatusActual}`).closest('.form-check-label').addClass('border-primary border-2');

            var estatusModal = new bootstrap.Modal(document.getElementById('estatusModal'));
            estatusModal.show();
        }

        // Manejar el cambio de selección de estatus
        $('.form-check-input[name="estatus"]').change(function() {
            $('.form-check-label').removeClass('border-primary border-2');
            $(this).closest('.form-check-label').addClass('border-primary border-2');
        });

        function guardarCambioEstatus() {
            var estatus = $('input[name="estatus"]:checked').val();
            if (!estatus) {
                Swal.fire('Error', 'Por favor seleccione un estatus', 'error');
                return;
            }

            var formData = {
                reserva_id: $('#reserva_id').val(),
                estatus: estatus,
                observaciones: $('#observaciones').val(),
                _token: $('input[name="_token"]').val()
            };

            $.ajax({
                url: '/reserva/cambiar-estatus',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'El estatus ha sido actualizado.',
                            icon: 'success'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'No se pudo actualizar el estatus.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
                }
            });

            $('#estatusModal').modal('hide');
        }
    </script>
</body>
</html>
