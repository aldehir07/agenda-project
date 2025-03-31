<?php

namespace App\Http\Controllers;

use App\Models\RegistroReserva;
use Illuminate\Http\Request;

class RegistroReservaController extends Controller
{

    public function index()
    {
        $reservas = RegistroReserva::orderBy('fecha_inicio', 'asc')->get(); // Ordenar por fecha de inicio
        return view('verRegistro.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistroReserva $registroReserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegistroReserva $registroReserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistroReserva $registroReserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistroReserva $registroReserva)
    {
        //
    }

    public function cambiarEstatus(Request $request)
    {
        try {
            $reserva = RegistroReserva::findOrFail($request->reserva_id);
            $reserva->estatus = $request->estatus;
            
            // Si hay observaciones, las guardamos
            if ($request->observaciones) {
                $reserva->observaciones = $request->observaciones;
            }
            
            $reserva->save();

            return response()->json([
                'success' => true,
                'message' => 'Estatus actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estatus'
            ], 500);
        }
    }
}
