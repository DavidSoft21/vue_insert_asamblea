<?php

use App\Http\Controllers\AsambleaController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\FormularioDetalleController;
use App\Http\Controllers\FormularioPreguntaController;
use App\Http\Controllers\OpcionesController;
use App\Http\Controllers\OpcionTemarioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TemarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/persona', PersonaController::class)->middleware('api');  
Route::post('/ImportExcelPersonas', [PersonaController::class, 'import']); 
Route::apiResource('/asamblea', AsambleaController::class)->middleware('api');  
Route::apiResource('/temario', TemarioController::class)->middleware('api');  
Route::get('/show_temerio_nombre/{nombre}',[TemarioController::class,'show_temerio_nombre'])->middleware('api');
Route::apiResource('/formulario', FormularioController::class)->middleware('api');  
Route::apiResource('/formulario_pregunta', FormularioPreguntaController::class)->middleware('api');  
Route::apiResource('/formulario_detalle', FormularioDetalleController::class)->middleware('api');  
Route::apiResource('/opcion_temario', OpcionTemarioController::class)->middleware('api');  
Route::apiResource('/opciones', OpcionesController::class)->middleware('api');  

