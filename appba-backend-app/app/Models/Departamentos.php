<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    protected $table = "departamentos";

    protected $fillable = [
        'nombre_dep',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function dni_emp(){
        return $this->belongsTo("app/Models/Empleado");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
