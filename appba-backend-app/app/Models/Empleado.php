<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = "empleados";

    protected $fillable = [
        'dni_emp',
        'fecha_inicio_emp',
        'fecha_fin_emp',
        'nombre_emp',
        'categoria_emp',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function getEmpleadosFromDepartamento(){
        
    }

    public function departamento_emp(){
        return $this->belongsTo("app/Models/Departamento");
    }

    public function marcajes(){
        return $this->hasMany("app/Models/Marcaje");
    }

    public function nominas(){
        return $this->hasMany("app/Models/Nomina");
    }

    public function solicitudes(){
        return $this->hasMany("app/Models/Solicitud");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];

}
