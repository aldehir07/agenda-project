<?php

namespace App\Http\Controllers;

use App\Models\ReservaCal;
use Illuminate\Http\Request;
use App\Models\RegistroReserva;

class ReservaCalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservaCals = ReservaCal::all();
        return view('calendario', compact('reservaCals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $fecha = $request->query('fecha');
        return view('reservaCal.create', compact('fecha'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'actividad' => 'required|string|max:255',
            'analista' => 'required|string|max:255',
            'salon' => 'required|string|in:"Auditorio Jorge L. Quijada",
                                        "Trabajo en Equipo",
                                        "Comunicación Asertiva",
                                        "Servicio al Cliente",
                                        "Integridad",
                                        "Creatividad Innovadora"',
            'depto_responsable' => 'required',
            'numero_evento' => 'required|numeric|digits:4',
            'scafid' => 'nullable|string',
            'mes' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'tipo_actividad' => 'required',
            'receso_am' => 'nullable',
            'receso_pm' => 'nullable',
            'publico_meta' => 'required|string',
            'cant_participantes' => 'required|numeric',
            'facilitador_moderador' => 'required|string',
            'estatus' => 'required',
            'insumos' => 'nullable|string',
            'requisitos_tecnicos' => 'nullable|string',
            'asistencia_tecnica' => 'required'

        ]);

        // Verificar si ya hay una reserva en el mismo horario y salón
        $existeReserva = ReservaCal::where('fecha', $request->fecha)
            ->where('salon', $request->salon)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fin', '>=', $request->hora_fin);
                    });
            })
            ->exists();

        if ($existeReserva) {
            // dd($existeReserva);

            return redirect()->route('calendario')->withInput()->with('error', '⚠️ Ya hay una reserva en ese salón para esa fecha y hora.');
        }

        // Si no hay conflicto, guardar la reserva
        ReservaCal::create($request->all());

        // Guardar en la tabla RegistroReserva
        RegistroReserva::create($request->all());

        return redirect()->route('calendario')->with('success', '✅ Reserva creada exitosamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(ReservaCal $reservaCal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReservaCal $reservaCal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReservaCal $reservaCal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservaCal $reservaCal)
    {
        //
    }
}
