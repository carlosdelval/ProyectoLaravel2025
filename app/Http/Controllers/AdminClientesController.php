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
    public function index()
    {
        return view('admin.clientes');
    }

    public function historial(User $user)
    {
        // Obtener el historial de graduaciones del usuario con paginación
        $historial = HistorialVista::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.historial', compact('user', 'historial'));
    }
}
