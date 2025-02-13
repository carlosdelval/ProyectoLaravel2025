<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialVista;

class CitaController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $citas = Cita::all();
        } else {
            $citas = Cita::where('user_id', Auth::id())->get();
        }
        return view('dashboard', compact('citas'));
    }

    // Muestra el formulario para reservar una cita
    public function create()
    {
        return view('users.reserva');
    }

    // Guarda la cita en la BD
    public function store(Request $request)
    {
        $request->validate([
            'fecha_reserva' => 'required|date|after_or_equal:today',
            'hora_mañana' => 'required|date_format:H:i',
            'hora_tarde' => 'required|date_format:H:i',
        ]);
        if(isset($request->hora_mañana)){
            $hora_reserva = $request->hora_mañana;
        }else{
            $hora_reserva = $request->hora_tarde;
        }
        Cita::create([
            'user_id' => Auth::id(),
            'fecha' => $request->fecha_reserva,
            'hora' => $hora_reserva,
        ]);

        return redirect()->route('dashboard')->with('success', 'Cita reservada con éxito.');
    }

    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        return view('admin.citas.editar', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        return view('admin.editar', compact('cita'));
    }

    /**
     * Actualiza la información de la cita.
     */
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'eje' => 'required|numeric',
            'cilindro' => 'nullable|numeric',
            'esfera' => 'nullable|numeric'
        ]);

        $historial = HistorialVista::where('cita_id', $cita->id)->first();

        if (!$historial) {
            return redirect()->route('dashboard')->with('error', 'No se encontró historial para esta cita.');
        }

        $historial->update([
            'eje' => $request->eje,
            'cilindro' => $request->cilindro,
            'esfera' => $request->esfera
        ]);

        return redirect()->route('dashboard')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);

        // Verifica que la cita pertenece al usuario logeado
        if ($cita->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'No puedes eliminar esta cita.');
        }

        $cita->delete();
        return redirect()->route('dashboard')->with('success', 'Cita anulada con éxito.');
    }
}
