<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";

    protected $fillable = [
        'fecha',
        'titulo',
        "descripcion",
        "created_at", 
        "updated_at", 
        "deleted_at"
    ];


    protected $dates = ["created_at", "updated_at", "deleted_at"];
   
}
