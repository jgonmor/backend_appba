<?php

namespace App\Http\Controllers;

use App\Models\AusenciasEmpleado;
use Illuminate\Http\Request;

class AusenciaEmpleadoController extends Controller
{
    public function restarHoras($id, $nhoras){
        $empleado = AusenciasEmpleado::where("id", $id)->first();
        $restantes = $empleado->horas_compensatorias_restantes - $nhoras;
        AusenciasEmpleado::where("id", $id)->update(["horas_compensatorias_restantes"=> $restantes]);
    }

    public function restarVacaciones($id, $dias){
        $empleado = AusenciasEmpleado::where("id", $id)->first();
        $restantes = $empleado->vacaciones_restantes - $dias;
        AusenciasEmpleado::where("id", $id)->update(["vacaciones_restantes" => $restantes]);
    }

    public function restarAsuntosPropios($id, $dias){

        $empleado = AusenciasEmpleado::where("id", $id)->first();
        $restantes = $empleado->asuntos_propios_restantes - $dias;
        AusenciasEmpleado::where("id", $id)->update(["asuntos_propios_restantes" => $restantes]);
    }

    public function getHorasRestantes($id){
        $horas = AusenciasEmpleado::where("id", $id)->first()->horas_compensatorias_restantes;

        $data = [
            'message' => "Horas restantes",
            'data' => $horas,
        ];
        return response()->json($data);
    }
    public function getVacacionesRestantes($id){
        $horas = AusenciasEmpleado::where("id", $id)->first()->vacaciones_restantes;

        $data = [
            'message' => "Vacaciones restantes",
            'data' => $horas,
        ];
        return response()->json($data);
    }
    public function getDiasRestantes($id){
        $horas = AusenciasEmpleado::where("id", $id)->first()->asuntos_propios_restantes;

        $data = [
            'message' => "Asuntos propios restantes",
            'data' => $horas,
        ];
        return response()->json($data);
    }

}
