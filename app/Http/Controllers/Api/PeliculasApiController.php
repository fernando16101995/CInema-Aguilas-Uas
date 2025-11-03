<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peliculas;

class PeliculasApiController extends Controller
{
    // GET /api/peliculas
    public function index(Request $request)
    {
        $query = Peliculas::query();
        if ($request->has('genre')) {
            $genre = $request->input('genre');
            $query->where('genre', 'LIKE', "%$genre%");
        }
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
