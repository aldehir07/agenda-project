<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['reserva_id', 'instructor', 'fecha_inicio', 'fecha_fin', 'requisitos'];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
