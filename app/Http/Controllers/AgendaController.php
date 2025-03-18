<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Agenda;
use App\Models\Models\Salon;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::with('salon')->get();
        return view('agenda.index', compact('agendas'));
    }

    public function create()
    {
        $salones = Salon::all();
        return view('agenda.create', compact('salones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'salon_id' => 'required|exists:salones,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string'
        ]);

        Agenda::create($request->all());

        return redirect()->route('agenda.index')->with('success', 'Agenda creada exitosamente.');
    }

    public function show(Agenda $agenda)
    {
        return view('agenda.show', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {
        $salones = Salon::all();
        return view('agenda.edit', compact('agenda', 'salones'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'salon_id' => 'required|exists:salones,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string'
        ]);

        $agenda->update($request->all());

        return redirect()->route('agenda.index')->with('success', 'Agenda actualizada.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Agenda eliminada.');
    }
}
