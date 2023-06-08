<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametrosPorDefecto extends Model
{
    use HasFactory;

    protected $table = "parametros_por_defecto";

    protected $fillable = [
        'clave',
        'valor',
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];


    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
