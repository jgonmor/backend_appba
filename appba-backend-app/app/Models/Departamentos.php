<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    protected $table = "departamentos";

    protected $fillable = [
        'nombre',
        'jefe',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function jefe(){
        return $this->belongsTo("app/Models/Empleado", "jefe");
    }

    public function empleados(){
        return $this->hasMany(Empleado::class);
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
