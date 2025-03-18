<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Models\Salon;

class SalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salones = [
            ['nombre' => 'Auditorio Jorge L. Quijada', 'capacidad' => 100, 'ubicacion' => 'Edificio Principal'],
            ['nombre' => 'Trabajo en Equipo', 'capacidad' => 50, 'ubicacion' => 'Piso 1'],
            ['nombre' => 'Comunicación Asertiva', 'capacidad' => 40, 'ubicacion' => 'Piso 2'],
            ['nombre' => 'Servicio al Cliente', 'capacidad' => 30, 'ubicacion' => 'Piso 2'],
            ['nombre' => 'Integridad', 'capacidad' => 25, 'ubicacion' => 'Piso 3'],
            ['nombre' => 'Creatividad Innovadora', 'capacidad' => 20, 'ubicacion' => 'Piso 3'],
        ];

        foreach ($salones as $salon) {
            Salon::create($salon);
        }
    }
}
