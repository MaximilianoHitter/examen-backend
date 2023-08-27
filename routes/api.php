<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PersonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/persona', PersonaController::class);
Route::post('/asign', [PersonaController::class, 'asign']);

Route::resource('/categoria', CategoriaController::class);

Route::resource('/curso', CursoController::class);
Route::get('/reportePorCurso', [CursoController::class, 'reportePorCurso']);
Route::get('/cursos-actualizados', [CursoController::class, 'cursos_actualizados']);