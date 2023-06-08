<?php

namespace App\Http\Controllers;

use App\Models\ParametrosPorDefecto;
use Illuminate\Http\Request;

class ParametroPorDefectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parametros = ParametrosPorDefecto::all();
        $data = [
            'message' => "Todos los parametros por defecto",
            'parametros' => $parametros,
        ];
        return response()->json($data);
    }

}
