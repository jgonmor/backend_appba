<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcaje extends Model
{
    use HasFactory;

    protected $table = "marcajes";

    protected $fillable = [
        'fecha_hora',
        'tipo',
        'empleado',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function empleado(){
        return $this->belongsTo("app/Models/Empleado", "empleado");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
