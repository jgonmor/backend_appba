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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado');
            $table->foreign('empleado')->references('id')->on('empleados');
            $table->dateTime('fecha_hora');
            $table->dateTime('fecha_hora_inicio');
            $table->dateTime('fecha_hora_fin');
            $table->enum("tipo", ["ASUNTOS_PROPIOS", "VACACIONES", "HORAS_COMPENSATORIAS"]);
            $table->enum("estado", ["EN_ESPERA", "ACEPTADA", "RECHAZADA"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
