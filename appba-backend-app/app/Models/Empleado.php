<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Empleado extends Model
{
    use HasFactory;
    protected $table = "empleados";

    protected $fillable = [
        'dni',
        'fecha_inicio',
        'fecha_fin',
        'nombre',
        'categoria',
        "departamento",
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];


    public function departamento(){
        return $this->belongsTo(Departamentos::class, "departamento");
    }

    public function user(): HasOne{
        return $this->hasOne(User::class, "dni", "DNI");
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
