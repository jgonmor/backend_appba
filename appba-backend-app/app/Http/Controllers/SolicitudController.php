<?php

namespace App\Http\Controllers;
use App\Models\Departamentos;
use App\Models\Empleado;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    
    
    public function getSolicitudesFromDepartamento(Departamentos $departamento)
    {
        $empleados = Empleado::where("departamento", $departamento->id)->pluck("id");
        $solicitudes = Solicitud::where("estado", "EN_ESPERA_JEFE")->whereIn("empleado", $empleados)->with("empleado")->get();

        $data = [
            'message' => "Solicitudes del departamento $departamento->nombre",
            'data' => $solicitudes,
        ];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $solicitud = new Solicitud;
        $solicitud->empleado = $request->empleado;
        $solicitud->fecha_hora = $request->fecha_hora;
        $solicitud->fecha_hora_inicio = $request->fecha_hora_inicio;
        $solicitud->fecha_hora_fin = $request->fecha_hora_fin;
        $solicitud->tipo = $request->tipo;
        $solicitud->estado = $request->estado;


        $solicitud->save();

        $data = [
            'message' => "Solicitud creada con exito",
            'solicitud' => $solicitud,
        ];

        return response()->json($data);
    }

    public function getSolicitudesPendienteRRHH()
    {

        $solicitudes = Solicitud::where("estado", "EN_ESPERA_RRHH")->with("empleado")->get();

        $data = [
            'message' => "Solicitudes en espera de RRHH",
            'data' => $solicitudes,
        ];
        return response()->json($data);
    }

    public function getSolicitudesFromEmployee($empleado)
    {

        $solicitudes = Solicitud::where("empleado", $empleado)->orderBy("fecha_hora", "desc")->get();

        $data = [
            'message' => "Solicitudes del empleado",
            'data' => $solicitudes,
        ];
        return response()->json($data);
    }

    public function update(Request $request)
    {
        // dd($request->id);
       
        Solicitud::where("id", $request->id)->update($request->toArray());
        $solicitud = Solicitud::where("id", $request->id)->first();
        $data = [
            'message' => "Solicitud actualizada con exito",
            'data' => $solicitud,
        ];

        return response()->json($data);
    }


}
