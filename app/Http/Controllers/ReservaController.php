<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Reserva;
use App\Models\Models\Salon;
use Illuminate\Support\Facades\Auth;


class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('salon', 'user')->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $salones = Salon::all();
        return view('reservas.create', compact('salones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'salon_id' => 'required|exists:salones,id',
            'fecha' => 'required|date',
            'turno' => 'required|in:A.M.,P.M.,Completo',
            'tema' => 'required|string',
            'analista' => 'required|string'
        ]);

        Reserva::create([
            'user_id' => Auth::id(),
            'salon_id' => $request->salon_id,
            'fecha' => $request->fecha,
            'turno' => $request->turno,
            'tema' => $request->tema,
            'analista' => $request->analista,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada exitosamente.');
    }

    public function show(Reserva $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }

    public function edit(Reserva $reserva)
    {
        $salones = Salon::all();
        return view('reservas.edit', compact('reserva', 'salones'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'salon_id' => 'required|exists:salones,id',
            'fecha' => 'required|date',
            'turno' => 'required|in:A.M.,P.M.,Completo',
            'tema' => 'required|string',
            'analista' => 'required|string'
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada.');
    }
}
