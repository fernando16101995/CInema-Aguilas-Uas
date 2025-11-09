<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetflixProfileController extends Controller
{
    /**
     * Muestra la pantalla de "¿Quién está viendo?".
     */
    public function index()
    {
        $profiles = Profile::where('user_id', Auth::id())->get();

        // Apunta a la vista profile
        return view('profile.index', ['profiles' => $profiles]);
    }

    /**
     * Muestra el formulario para crear un nuevo perfil.
     */
    public function create()
    {
      $avatars = [
            'http://placehold.co/150x150/E50914/FFFFFF?text=P1', // Rojo
            'http://placehold.co/150x150/3070B8/FFFFFF?text=P2', // Azul
            'http://placehold.co/150x150/F5A623/FFFFFF?text=P3', // Amarillo
            'http://placehold.co/150x150/5E5E5E/FFFFFF?text=P4', // Gris
            'http://placehold.co/150x150/00A8E1/FFFFFF?text=P5', // Azul Claro
        ];

        // 2. Enviamos la lista de avatares a la vista.
        return view('profile.create', ['avatars' => $avatars]);
       
    }

    /**
     * Guarda el nuevo perfil en MongoDB.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_perfil' => 'required|string|max:100',
            
            'avatar_url' => 'required|string|url', 
        ]);

        Profile::create([
            'user_id' => Auth::id(),
            'nombre_perfil' => $request->nombre_perfil,
            'avatar_url' => $request->avatar_url ?? 'https://via.placeholder.com/150/374151?text=Perfil',
            'es_niño' => $request->has('es_niño'),
        ]);

        return redirect()->route('profiles.index')->with('success', 'Perfil creado.');
    }
    public function select(Profile $profile) // Usamos Route-Model Binding para encontrar el perfil
    {
        // 1. (Seguridad) Nos aseguramos de que este perfil ($profile)
        //    pertenezca al usuario ($user) que está logueado.
        if ($profile->user_id !== Auth::id()) {
            abort(403); // Error 403: Prohibido
        }

        // 2.  Guardamos el ID del perfil de MongoDB en la sesión
        //    Ahora, en cualquier parte de la app, sabremos quién está viendo.
        session(['active_profile_id' => $profile->id]);

        // 3. Redirigimos al usuario al dashboard principal 
        return redirect()->route('dashboard'); 
    }
}
