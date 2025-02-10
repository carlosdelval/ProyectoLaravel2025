<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HistorialVista;
use Illuminate\Support\Facades\Auth;

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
            'dni' => 'required|string',
            'tlf' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->dni = $request->dni;
        $user->tlf = $request->tlf;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
