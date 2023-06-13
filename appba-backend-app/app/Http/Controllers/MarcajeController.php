<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Marcaje;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use App\Models\Departamentos;

class MarcajeController extends Controller
{

    /**https://calendarific.com/api/v2
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $marcajes = Marcaje::all()->orderBy("fecha_hora", "desc");
        return response()->json($marcajes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function getMarcajesFromEmpleado(Empleado $empleado)
    {


        $marcajes = Marcaje::where("empleado", $empleado->id)->orderBy("fecha_hora", "desc")->get();

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

        $mes = Carbon::now()->month;
        $year = Carbon::now()->year;
        $diasMes = Carbon::now()->daysInMonth;
        $inicio = Carbon::createFromDate($year, $mes, 1);
        $fin = Carbon::createFromDate($year, $mes, $diasMes);

        $period = CarbonPeriod::create($inicio, $fin);

        $url = "https://calendarific.com/api/v2/holidays?api_key=b8f94c51e3bfdb7425495d615968b5d49e5a87cd&country=ES&year=$year&month=$mes&type=national";

        $opciones = array(
            'http' =>
            array(
                'method' => 'GET',
                'max_redirects' => '0',
                'ignore_errors' => '1'
            )
        );
        $contexto = stream_context_create($opciones);
        $flujo = fopen($url, 'r', false, $contexto);


        $festivos = json_decode(stream_get_contents($flujo), true);
        fclose($flujo);

        $diasFestivos = [];
        foreach ($festivos["response"]["holidays"] as $i => $festivo) {
            $diasFestivos[$i] = $festivo["date"]["iso"];
        }
        // dd($xd);
        $dias = [];
        foreach ($period as $i => $date) {
            if ($date->dayOfWeek <= 5 && $date->dayOfWeek > 0 && !in_array($date->format("Y-m-d"), $diasFestivos)) {
                $dias[$i] = $date->format("Y-m-d");
            }
        }


        $horasMes = count($dias) * 8;

        $data = [
            'message' => "Horas trabajadas este mes",
            'horas' => $horas,
            'horasMes' =>$horasMes
        ];

        return response()->json($data);
    }

    public function getHoursTotalMonth(){
        $mes = Carbon::now()->month;
        $year = Carbon::now()->year;
        $diasMes = Carbon::now()->daysInMonth;
        $inicio = Carbon::createFromDate($year, $mes, 1);
        $fin = Carbon::createFromDate($year, $mes, $diasMes);

        $period = CarbonPeriod::create($inicio, $fin);

        $url = "https://calendarific.com/api/v2/holidays?api_key=b8f94c51e3bfdb7425495d615968b5d49e5a87cd&country=ES&year=$year&month=$mes&type=national";

        $opciones = array(
            'http' =>
            array(
                'method' => 'GET',
                'max_redirects' => '0',
                'ignore_errors' => '1'
            )
        );
        $contexto = stream_context_create($opciones);
        $flujo = fopen($url, 'r', false, $contexto);


        $festivos = json_decode(stream_get_contents($flujo), true);
        fclose($flujo);

        $diasFestivos = [];
        foreach ($festivos["response"]["holidays"] as $i => $festivo) {
            $diasFestivos[$i] = $festivo["date"]["iso"];
        }
        // dd($xd);
        $dias = [];
        foreach ($period as $i => $date) {
            if ($date->dayOfWeek <= 5 && $date->dayOfWeek > 0 && !in_array($date->format("Y-m-d"), $diasFestivos)) {
                $dias[$i] = $date->format("Y-m-d");
            }
        }


        $horasMes = count($dias) * 8;

        $data = [
            'message' => "Horas objetivo de este mes",
            "horasMes" => $horasMes,
        ];

        return response()->json($data);
    }

    public function getHoursMonthDepartment(Departamentos $departamento)
    {
       


        $empleados = Empleado::where("departamento", $departamento->id)->get();
        $empleadosConHoras = [];

        foreach ($empleados as $i => $empleado) {
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

            $empleadoArray = $empleado->toArray();
            

            $empleadoArray["horas"] = $horas;
            $empleadosConHoras[$i] = $empleadoArray;
        }


        $data = [
            'message' => "Horas trabajadas este mes",
            'empleados' => $empleadosConHoras,
        ];

        return response()->json($data);
    }
    /**
     * Display the specified resource.
     */
    public  function show(Marcaje $marcaje)
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
