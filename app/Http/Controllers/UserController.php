<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HistorialVista;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show(User $user)
    {
        // Verifica que el usuario autenticado solo pueda ver su propio perfil
        if (Auth::id() !== $user->id) {
            abort(403, 'No tienes permiso para ver esta página');
        }

        // Cargar la relación historialVista
        $user->load('historialVista');

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'dni' => 'required|string',
            'tlf' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->dni = $request->dni;
        $user->tlf = $request->tlf;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'dni' => 'required|string|regex:/^[0-9]{8}[A-Za-z]$/',
            'tlf' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string', // Ahora puede estar vacío
        ]);

        // Construimos el array de datos para actualizar
        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'dni' => $request->dni,
            'tlf' => $request->tlf,
            'email' => $request->email,
        ];

        // Solo actualizar la contraseña si el usuario ingresó una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Actualizamos con un solo update
        $user->update($data);

        return redirect()->route('admin.clientes')->with('success', 'Usuario actualizado correctamente');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.clientes')->with('success', 'Usuario eliminado correctamente');
    }

    // Marcar todas las notificaciones como leídas
    public function marcarNotificacionesLeidas()
{
    Auth::user()->unreadNotifications->markAsRead();
    return back();
}
}
