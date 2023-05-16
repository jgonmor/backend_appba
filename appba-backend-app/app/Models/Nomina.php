<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use HasFactory;

    protected $table = "nominas";

    protected $fillable = [
        'fecha_nom',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];

    public function dni_emp(){
        return $this->belongsTo("app/Models/Empleado");
    }

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
