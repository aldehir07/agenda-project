<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroReserva extends Model
{
    use HasFactory;

    protected $table = 'registro_reservas';

    protected $fillable = [
        'fecha',
        'salon',
        'hora_inicio',
        'hora_fin',
        'actividad',
        'analista',
        'depto_responsable',
        'numero_evento',
        'scafid',
        'mes',
        'fecha_inicio',
        'fecha_final',
        'tipo_actividad',
        'receso_am',
        'receso_pm',
        'participantes',
        'estatus',
        'requisitos_tecnicos',
        'insumos',
        'observaciones'
    ];
}
