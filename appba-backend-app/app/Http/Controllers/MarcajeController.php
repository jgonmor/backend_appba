<?php

namespace App\Http\Controllers;

use App\Models\Marcaje;
use Illuminate\Http\Request;

class MarcajeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $marcajes = Marcaje::all();
        return response()->json($marcajes);
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
        $marcaje = new Marcaje;
        $marcaje->tipo = $request->tipo;
        $marcaje->fecha_hora = $request->fecha_hora;
        $marcaje->empleado = $request->empleado;      
        
       
        $marcaje->save();

        $data = [
            'message' => "Marcaje creado con exito",
            'marcaje' => $marcaje,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marcaje $marcaje)
    {
        return response()->json($marcaje);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marcaje $marcaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marcaje $marcaje)
    {
        //
        $marcaje->tipo = $request->tipo;
        $marcaje->fecha_hora = $request->fecha_hora;
        $marcaje->empleado = $request->empleado;  

        $marcaje->save();

        $data = [
            'message' => "Marcaje actualizado con exito",
            'marcaje' => $marcaje,
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marcaje $marcaje)
    {
        $marcaje->delete();

        $data = [
            'message' => "Marcaje eliminado con exito",
            'marcaje' => $marcaje,
        ];

        return response()->json($data);
    }
}
