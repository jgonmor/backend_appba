<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MarcajeController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\NominaController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::get('/empleados', [EmpleadoController::class, 'index']);
Route::post('/empleados', [EmpleadoController::class, 'store']);
Route::get('/empleados/{empleado}', [EmpleadoController::class, 'show']);
Route::get('/empleados/fromDepartamento/{departamento}', [EmpleadoController::class, 'getEmpleadoFromDepartamento']);
Route::put('/empleados/{empleado}', [EmpleadoController::class, 'update']);
Route::delete('/empleados/{empleado}', [EmpleadoController::class, 'destroy']);

Route::get('/marcaje', [MarcajeController::class, 'index']);
Route::post('/marcaje', [MarcajeController::class, 'create']);
Route::get('/marcaje/{marcaje}', [MarcajeController::class, 'show']);
Route::get('/marcaje/fromEmpleado/{empleado}', [MarcajeController::class, 'getMarcajesFromEmpleado']);
Route::get('/marcaje/fromEmpleado/{empleado}/last', [MarcajeController::class, 'getLastMarcajeFromEmpleado']);
Route::get('/marcaje/getHours/{empleado}', [MarcajeController::class, 'getHoursMonth']);
Route::put('/marcaje/{marcaje}', [MarcajeController::class, 'update']);
Route::delete('/marcaje/{marcaje}', [MarcajeController::class, 'destroy']);

Route::get('/departamentos', [DepartamentosController::class, 'index']);
Route::post('/departamentos', [DepartamentosController::class, 'store']);
Route::get('/departamentos/{departamentos}', [DepartamentosController::class, 'show']);
Route::put('/departamentos', [DepartamentosController::class, 'update']);
Route::delete('/departamentos/{departamento}', [DepartamentosController::class, 'destroy']);


Route::post('/empleados/uploadPayslip', [NominaController::class, 'store']);
Route::get('/empleados/downloadPayslip/{dni}/{name}', [NominaController::class, 'downloadPayslip']);

Route::get('/locations', [LocationsController::class, 'index']);
Route::post('/locations', [LocationsController::class, 'store']);
Route::get('/locations/{location}', [LocationsController::class, 'show']);
Route::get('/locations/byCategory/{category}', [LocationsController::class, 'byCategory']);
Route::put('/locations', [LocationsController::class, 'update']);
Route::delete('/locations/{locations}', [LocationsController::class, 'destroy']);


