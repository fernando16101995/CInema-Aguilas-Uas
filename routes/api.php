<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Models\User;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});
//api para traerme todos los usuarios
Route::get('/users', function () {
    return response()->json(User::all());
});

//api para contar todos los usuarios
Route::get('/users/count', function () {
    return response()->json(['count' => User::count()]);
});

//api para traer usuarios por id
Route::get('/users/{id}', function ($id) {
    $user = User::find($id);
    if ($user) {
        return response()->json($user);
    }
    return response()->json(['error' => 'Usuario no encontrado'], 404);
});


    