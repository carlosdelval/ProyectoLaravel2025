<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialVista;
use Carbon\Carbon;
use App\Models\Optica;
use App\Models\User;
use App\Notifications\NuevaCitaReservada;
use App\Notifications\CitaGraduada;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    // Muestra el formulario para reservar una cita, mandando un array con todas las opticas disponibles
    public function create()
    {
        $opticas = Optica::all();
        return view('users.reserva')->with('opticas', $opticas);
    }

    // Guarda la cita en la BD
    public function store(Request $request)
    {
        $request->validate([
            'fecha_reserva' => 'required|date|after_or_equal:today',
            'periodo' => 'required|in:mañana,tarde',
            'hora_mañana' => 'nullable|required_if:periodo,mañana|date_format:H:i',
            'hora_tarde' => 'nullable|required_if:periodo,tarde|date_format:H:i',
            'optica' => 'required|exists:opticas,id'
        ]);

        // Seleccionar la hora según el periodo
        $hora = ($request->periodo === 'mañana') ? $request->hora_mañana : $request->hora_tarde;

        // Comprobar si ya existe una cita en esa fecha y hora en la optica elegida
        $citaExistente = Cita::where('fecha', $request->fecha_reserva)
            ->where('hora', $hora)
            ->where('optica_id', $request->optica)
            ->exists();

        if ($citaExistente) {
            return redirect()->route('user.reserva')->with('error', 'Ya existe una cita en esa fecha y hora. Por favor, selecciona otra fecha u hora distinta.');
        } else {
            // Crear la cita
            $cita = Cita::create([
                'user_id' => Auth::id(),
                'fecha' => $request->fecha_reserva,
                'hora' => $hora,
                'optica_id' => $request->optica
            ]);

            // Obtener al admin (ajusta esto según tu lógica de usuarios)
            $admin = User::where('role', 'admin')->first();

            if ($admin) {
                $admin->notify(new NuevaCitaReservada($cita));
            }


            return redirect()->route('dashboard')->with('success', 'Cita reservada con éxito.');
        }
    }


    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        return view('admin.citas.editar', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        return view('admin.asignar', compact('cita'));
    }

    /**
     * Actualiza la información de la cita o crea una nueva si no existe
     */
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'eje' => 'required|numeric',
            'cilindro' => 'nullable|numeric',
            'esfera' => 'nullable|numeric',
            'revision_pdf' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        $historial = HistorialVista::firstOrCreate(
            ['cita_id' => $cita->id],
            ['user_id' => $cita->user_id, 'eje' => $request->eje, 'cilindro' => $request->cilindro, 'esfera' => $request->esfera]
        );

        if ($request->hasFile('revision_pdf')) {
            $filePath = $request->file('revision_pdf')->store('revisiones', 'public');
            $historial->update(['documentacion' => $filePath]);
        } else {
            $historial->update([
                'eje' => $request->eje,
                'cilindro' => $request->cilindro,
                'esfera' => $request->esfera
            ]);
        }
        $this->graduar($cita->id);
        return redirect()->route('dashboard')->with('success', 'Cita graduada correctamente.');
    }


    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);

        // Verifica que la cita pertenece al usuario logeado o eres admin
        if ($cita->user_id === Auth::id() || Auth::user()->role === 'admin') {
            $cita->delete();
            return redirect()->route('dashboard')->with('success', 'Cita anulada con éxito.');
        } else {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para anular esta cita.');
        }
    }

    public function graduar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update(['graduada' => 1]);

        // Notificar al usuario
        $cita->user->notify(new CitaGraduada($cita));

        // Verificar si el usuario ya está registrado como cliente de la óptica
        $existeRelacion = DB::table('optica_user')
            ->where('user_id', $cita->user_id)
            ->where('optica_id', $cita->optica_id)
            ->exists();

        // Si no existe la relación, la creamos
        if (!$existeRelacion) {
            DB::table('optica_user')->insert([
                'user_id' => $cita->user_id,
                'optica_id' => $cita->optica_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
