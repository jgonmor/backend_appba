<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MarcajeController;
use App\Http\Controllers\DepartamentosController;
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

Route::get('/empleados', [EmpleadoController::class, 'index']);
Route::post('/empleados', [EmpleadoController::class, 'store']);
Route::get('/empleados/{empleado}', [EmpleadoController::class, 'show']);
Route::put('/empleados/{empleado}', [EmpleadoController::class, 'update']);
Route::delete('/empleados/{empleado}', [EmpleadoController::class, 'destroy']);

Route::get('/marcaje', [MarcajeController::class, 'index']);
Route::post('/marcaje', [MarcajeController::class, 'store']);
Route::get('/marcaje/{marcaje}', [MarcajeController::class, 'show']);
Route::put('/marcaje/{marcaje}', [MarcajeController::class, 'update']);
Route::delete('/marcaje/{marcaje}', [MarcajeController::class, 'destroy']);

Route::get('/departamentos', [DepartamentosController::class, 'index']);
Route::post('/departamentos', [DepartamentosController::class, 'store']);
Route::get('/departamentos/{departamentos}', [DepartamentosController::class, 'show']);
Route::put('/departamentos', [DepartamentosController::class, 'update']);
Route::delete('/departamentos/{departamento}', [DepartamentosController::class, 'destroy']);


