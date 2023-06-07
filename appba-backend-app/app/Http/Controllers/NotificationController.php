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
        $notification = Notification::all();
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

    public function getMarcajesFromEmpleado(Empleado $empleado)
    {


        $marcajes = Marcaje::where("empleado", $empleado->id)->get();

        $data = [
            'message' => "Marcaje creado con exito",
            'marcaje' => $marcajes,
        ];

        return response()->json($data);
    }

    public function getLastMarcajeFromEmpleado(Empleado $empleado)
    {


        $marcajes = Marcaje::where("empleado", $empleado->id)->orderBy("fecha_hora", "desc")->first();

        $data = [
            'message' => "Ultimo marcaje",
            'marcaje' => $marcajes,
        ];

        return response()->json($data);
    }

    public function getHoursMonth(Empleado $empleado)
    {
        $entradas = Marcaje::whereRaw("empleado = $empleado->id and tipo = 'ENTRADA'")
            ->whereYear('fecha_hora', Carbon::now()->year)
            ->whereMonth('fecha_hora', Carbon::now()->month)
            ->pluck("fecha_hora")->toArray();
        $salidas = Marcaje::whereRaw("empleado = $empleado->id and tipo = 'SALIDA'")
            ->whereYear('fecha_hora', Carbon::now()->year)
            ->whereMonth('fecha_hora', Carbon::now()->month)
            ->pluck("fecha_hora")->toArray();
        $horas = 0;
        foreach ($entradas as $key => $entrada) {
            $horaIni = new Carbon($entrada);
            if (array_key_exists($key, $salidas)) {
                $horafin = new Carbon($salidas[$key]);
            } else {
                $horafin = Carbon::now();
            }
            $horas += $horaIni->diffInHours($horafin);
        }

        $data = [
            'message' => "Horas trabajadas este mes",
            'horas' => $horas,
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
