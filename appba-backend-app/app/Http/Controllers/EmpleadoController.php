<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamentos;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empleados = Empleado::with("departamento")->get();
        $data = [
            'message' => "Todos los empleados",
            'empleado' => $empleados,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $empleado = new Empleado;
        $empleado->dni = $request->dni;
        $empleado->fecha_inicio = $request->fecha_inicio;
        $empleado->nombre = $request->nombre;
        $empleado->categoria = $request->categoria;
        $empleado->departamento = $request->departamento;
        
        
       
        $empleado->save();

        $data = [
            'message' => "Empleado creado con exito",
            'empleado' => $empleado,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        dd($empleado);
        // $empleado->with("departamento");
        // $empleado->departamento = Departamentos::find($empleado->departamento);
        $empleado = $empleado->with("departamento")->get();

        $data = [
            'message' => "Detalles del empleado",
            'empleado' => $empleado,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
        $empleado->dni = $request->dni;
        $empleado->nombre = $request->nombre;
        $empleado->categoria = $request->categoria;
        $empleado->fecha_inicio = $request->fecha_inicio;
        $empleado->fecha_fin = $request->fecha_fin;

        $empleado->save();

        $data = [
            'message' => "Empleado actualizado con exito",
            'empleado' => $empleado,
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        $data = [
            'message' => "Empleado eliminado con exito",
            'empleado' => $empleado,
        ];

        return response()->json($data);
    }

       
}
