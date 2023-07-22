<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;

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

Route::get('/articulos', [ArticuloController::class,'index']); //muestra todos los registros
Route::post('/articulos', [ArticuloController::class,'store']); //guarda el registro
Route::get('/articulos/{id}', [ArticuloController::class,'show']); //get id el registro
Route::put('/articulos/{id}', [ArticuloController::class,'update']); //actualiza el registro
Route::delete('/articulos/{id}', [ArticuloController::class,'destroy']); //elimina el registro

