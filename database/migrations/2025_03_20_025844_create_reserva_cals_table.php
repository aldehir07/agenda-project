<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserva_cals', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->text('actividad');
            $table->string('analista');
            $table->string('salon');
            $table->string('depto_responsable');
            $table->string('numero_evento', 4);
            $table->string('scafid')->nullable();
            $table->string('mes');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->enum('tipo_actividad', ['Reunion', 'Capacitacion', 'REPLICA']);
            $table->time('receso_am')->nullable();
            $table->time('receso_pm')->nullable();
            $table->string('publico_meta');
            $table->integer('cant_participantes');
            $table->string('facilitador_moderador');
            $table->enum('estatus', ['Programado', 'Cancelado', 'Realizado']);
            $table->text('insumos')->nullable();
            $table->text('requisitos_tecnicos')->nullable();
            $table->enum('asistencia_tecnica', ['Si', 'No']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_cals');
    }
};
