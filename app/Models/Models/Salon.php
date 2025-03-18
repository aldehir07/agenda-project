<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'capacidad', 'ubicacion'];
    protected $table = 'salones'; // Cambia esto si la tabla es "salones"

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
