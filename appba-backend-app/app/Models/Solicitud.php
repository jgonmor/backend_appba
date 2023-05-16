<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = "solicitudes";

    protected $fillable = [
        'fecha_hora_sol',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'tipo_sol',
        'estado_sol',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function dni_emp(){
        return $this->belongsTo("app/Models/Empleado");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
