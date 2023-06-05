<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Nomina;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if($request->hasFile("file")){
            $file = $request->file("file");
            $empleado = $request["empleado"];
            $dni = Empleado::where("id", $empleado)->first()->dni;
            $date = Carbon::now()->toDateString();
             
            $extension = $file->getClientOriginalExtension();
            $fileName = $date.".".$extension;

            $file->move(public_path("files/payslips/$dni/"), $fileName);


            $nomina = new Nomina([
                'fecha' => $date,
                'empleado' => $empleado,
                "path" =>$fileName
            ]);

            $nomina->save();

            $data = [
                'message' => "Nomina subida con exito",
                'nomina' => "$dni/$fileName",
            ];
        }else{
            $data = [
                'message' => "Error al subir la nomina"
            ];
        }

        return response()->json($data);
    }

    public function downloadPayslip($dni, $name){
            // $path = "files/payslips/$dni/";
            
            $path = public_path("files/payslips/$dni/");
            if(file_exists($path.$name)){
                return response()->download($path.$name);
            }
            $data = [
                'message' => "Esa nomina no existe"
            ];
            return response()->json($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(Nomina $nomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nomina $nomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nomina $nomina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nomina $nomina)
    {
        //
    }
}
