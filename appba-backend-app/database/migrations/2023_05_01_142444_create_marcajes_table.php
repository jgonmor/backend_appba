<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marcajes', function (Blueprint $table) {
            $table->id("id");
            $table->dateTime('fecha_hora');
            $table->enum("tipo", ["ENTRADA", "SALIDA"]);
            $table->unsignedBigInteger('empleado');
            // $table->foreign('empleado')->references('id')->on('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcajes');
    }
};
