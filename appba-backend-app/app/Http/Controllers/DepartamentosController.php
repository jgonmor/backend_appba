<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departamentos = Departamentos::with("jefe")->get();
        $data = [
            'message' => "Datos de los departamentos",
            'departamentos' => $departamentos,
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
        $departamentos = new Departamentos;
        $departamentos->nombre = $request->nombre;
        $departamentos->jefe = $request->jefe;
    
        
       
        $departamentos->save();

        $data = [
            'message' => "Departamento creado con exito",
            'departamentos' => $departamentos,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Departamentos $departamentos)
    {
        dd($departamentos);
        $departamentos = $departamentos->with("empleados", "jefe")->where("id", $departamentos->id)->get();

        $data = [
            'message' => "Datos del departamento",
            'departamento' => $departamentos,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamentos $departamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departamentos $departamentos)
    {

        $departamentos->nombre = $request->nombre;
        $departamentos->jefe = $request->jefe;

        $result = Departamentos::where("id", $request->id)->first()->update($departamentos->toArray());

        if ($result){
            $result = Departamentos::find($request->id);
        }

        $data = [
            'message' => "Departamento actualizado con exito",
            'departamentos' => $result,
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamentos $departamentos)
    {
        $departamentos->delete();

        $data = [
            'message' => "Departamento eliminado con exito",
            'departamentos' => $departamentos,
        ];

        return response()->json($data);
    }
}
