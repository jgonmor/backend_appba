<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AusenciasEmpleado extends Model
{
    use HasFactory;

    protected $table = "ausencia__empleados";

    protected $fillable = [
        'vacaciones_restantes',
        'asuntos_propios_restantes',
        'horas_compensatorias_restantes',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function dni_emp(){
        return $this->belongsTo("app/Models/Empleado");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
