<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = "solicitudes";

    protected $fillable = [
        'fecha_hora',
        'fecha_hora',
        'fecha_hora',
        'tipo',
        'estado',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function empleado(){
        return $this->belongsTo("app/Models/Empleado");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
