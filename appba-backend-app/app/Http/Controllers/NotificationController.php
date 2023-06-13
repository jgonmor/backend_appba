<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Marcaje;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notification = Notification::orderBy("fecha", "desc")->get();
        $data = [
            'message' => "Todas las notificaciones",
            'data' => $notification,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $notification = new Notification;
        $notification->titulo = $request->titulo;
        $notification->fecha = $request->fecha;
        $notification->descripcion = $request->descripcion;


        $notification->save();

        $data = [
            'message' => "Notificacion creada con exito",
            'data' => $notification,
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
