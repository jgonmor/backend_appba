<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function jefe(): HasOne{
        return $this->hasOne(Empleado::class, "departamento" ,"jefe");
    }

    public function empleados(){
        return $this->hasMany(Empleado::class, "departamento");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
