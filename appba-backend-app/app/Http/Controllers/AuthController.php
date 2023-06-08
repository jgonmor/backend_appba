<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;
use App\Models\Empleado;
use App\Models\User;

class AuthController extends Controller
{
    function login(Request $request)
    {

        $user = User::where("DNI", $request->DNI)->first();
        if ($user && $user->password === $request->password) {
            $token = $user->createToken("Login token")->plainTextToken;
            $employee = Empleado::find($user->id)->with("departamento")->first();
            $employee->rol = $user->rol;
            $response = [
                "token" => $token,
                "empleado" => $employee,       
            ];
            $data = [
                "message" => "Ha iniciado sesion correctamente",
                'data' => $response,
            ];
           
            return response()->json($data, status:500);
        } else if ($user == null) {
            $response = [
                "message" => "Ese usuario no existe"
            ];
            return response()->json($response, status:500);
        }else{
            $response = [
                "message" => "Contraseña incorrecta"
            ];
            return response()->json($response, status:500);
        }
    }
}
