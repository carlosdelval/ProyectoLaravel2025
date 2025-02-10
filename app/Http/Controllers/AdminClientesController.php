<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HistorialVista;

class AdminClientesController extends Controller
{
    /**
     * Muestra la lista de clientes con filtros de búsqueda.
     */
    public function index(Request $request)
    {
        // Filtrar usuarios por nombre, apellidos, teléfono o DNI
        $query = User::where('role', 'user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('tlf', 'like', "%$search%")
                    ->orWhere('dni', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10);

        return view('admin.clientes', compact('users'));
    }

    public function historial(User $user)
    {
        // Obtener el historial de graduaciones del usuario con paginación
        $historial = HistorialVista::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.historial', compact('user', 'historial'));
    }
}
