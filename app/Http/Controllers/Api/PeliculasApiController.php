<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peliculas;
use App\Models\HistorialVista;

class PeliculasApiController extends Controller
{
public function index(Request $request)
    {
        if ($request->has('perfil_id')) {
            
            $perfilId = $request->input('perfil_id');
            
            //  Busca en MongoDB el historial de ESE perfil
            $historial = HistorialVista::where('perfil_id', $perfilId)
                                        ->orderBy('updated_at', 'desc')
                                        ->take(10)
                                        ->pluck('pelicula_id'); // IDs de Postgres

            if ($historial->count() == 0) {
                return response()->json([]); // Devuelve un array vacío si no hay historial
            }

            // 3. Busca las películas en Postgres y las reordena
            $peliculas = Peliculas::findMany($historial)
                                  ->sortBy(function ($pelicula) use ($historial) {
                                      return array_search($pelicula->id, $historial->toArray());
                                  });
            
            // 4. Devuelve la lista ordenada
            return response()->json($peliculas->values());
        }
        

        
        // --- Lógica de Género 
        $query = Peliculas::query();
        if ($request->has('genre')) {
            $genre = $request->input('genre');
            $query->where('genre', 'LIKE', "%$genre%");
        }
        
        // --- Devuelve todas las películas si no hay filtros ---
        return response()->json($query->get());
    }

    // GET /api/peliculas/{id}
    public function show($id)
    {
        $pelicula = Peliculas::find($id);
        if ($pelicula) {
            return response()->json($pelicula);
        }
        return response()->json(['error' => 'Película no encontrada'], 404);
    }
}
