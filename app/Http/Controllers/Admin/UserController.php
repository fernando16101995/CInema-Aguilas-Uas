<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Asegúrate de importar tu modelo User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios para administrar.
     */
    public function index()
    {
        $users = User::all(); // Obtiene todos los usuarios

        // Devuelve a la vista: resources/views/admin/users/administrar-usuarios.blade.php
        return view('admin.users.administrar-usuarios', compact('users')); 
    }

    /**
     * Elimina el usuario especificado.
     */
    public function destroy(User $user) // encuentra al usuario por ID
    {
        // Previene que el admin se borre a sí mismo
        if ($user->id == auth()->id()) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Alterna el rol de admin para el usuario especificado.
     */
    public function toggleAdmin(User $user) // encuentra al usuario por ID
    {
        // Previene que el admin cambie su propio rol
        if ($user->id == auth()->id()) {
            return back()->with('error', 'No puedes cambiar tu propio rol.');
        }

        // Cambia el rol
        $user->role = ($user->role == 'admin') ? 'user' : 'admin';
        $user->save(); // Guarda el cambio
        
        return back()->with('success', 'Rol de usuario actualizado.');
    }
}
