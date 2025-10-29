<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peliculas; 
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    /**
     * Muestra la lista de películas para administrar.
     */
    public function index()
    {
        $peliculas = Peliculas::all(); 
        
        return view('admin.peliculas.administrar-peliculas', [
            'peliculas' => $peliculas
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva película.
     */
    public function create()
    {
        // Apunta a form-peliculas.blade.php
        return view('admin.peliculas.form-peliculas'); 
    }
    
    /**
     * Procesa y guarda una nueva película.
     */
    public function store(Request $request)
    {
       $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'poster_url' => 'required|url',
            'genre' => 'required|max:100',
            'duration_minutes' => 'nullable|integer',
            'video_url' => 'nullable|url',
        ]);
        
        // 2. Creación del nuevo registro 
        Peliculas::create([
            'title' => $request->title,
            'description' => $request->description,
            'poster_url' => $request->poster_url,
            'genre' => $request->genre,
            'duration_minutes' => $request->duration_minutes,
            'video_url' => $request->video_url,
        ]);

        // 3. Redirección con mensaje de éxito 
        return redirect()->route('admin.peliculas.index')->with('success', '¡Película añadida correctamente!');
    }

    /**
     * Muestra el formulario de edición con los datos cargados.
     
     */
    public function edit($id)
    {
        // Buscamos la película por ID.
        $pelicula = Peliculas::findOrFail($id);
        
        // Carga la vista del formulario de edición
        return view('admin.peliculas.editar-pelicula', [
            'pelicula' => $pelicula
        ]);
    }

    /**
     * Procesa la solicitud de actualización y guarda los cambios.
 
     */
    public function update(Request $request, $id) // Acepta el ID
    {
        // Validación de datos 
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'genre' => 'required',
            'duration_minutes' => 'nullable|integer',
           
        ]);

        // 1. Busca la película a modificar.
        $pelicula = Peliculas::findOrFail($id);
        
        // 2. Actualiza los campos
        $pelicula->title = $request->input('title');
        $pelicula->description = $request->input('description');
        $pelicula->genre = $request->input('genre');
        $pelicula->duration_minutes = $request->input('duration_minutes');
        $pelicula->poster_url = $request->input('poster_url'); 
        $pelicula->video_url = $request->input('video_url'); 
        
     
        $pelicula->save();

        // 4. Redirige al índice con un mensaje de éxito
        return redirect()->route('admin.peliculas.index')->with('success', 'Película modificada correctamente.');
    }

    /**
     * Elimina la película de la base de datos 
     */
    public function destroy($id) 
    {
        try {
            // Buscamos y eliminamos por ID
            Peliculas::findOrFail($id)->delete();
            
            return redirect()->route('admin.peliculas.index')->with('success', 'Película eliminada correctamente.');

        } catch (\Exception $e) {
            \Log::error('Error de eliminación: ' . $e->getMessage());
            return redirect()->route('admin.peliculas.index')->with('error', 'Error CRÍTICO: No se pudo eliminar la película.');
        }
    }

    
}