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
        'dni_emp',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];


    protected $dates = ["created_at", "updated_at", "deleted_at"];
   
}
