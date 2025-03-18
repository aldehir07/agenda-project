<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'salon_id', 'tema', 'turno', 'fecha', 'analista', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    public function agenda()
    {
        return $this->hasOne(Agenda::class);
    }
}
