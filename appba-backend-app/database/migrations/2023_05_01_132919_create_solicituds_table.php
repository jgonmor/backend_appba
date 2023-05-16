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
            $table->integer("id_sol", true, true);
            $table->string('dni_emp', 9);
            $table->foreign('dni_emp')->references('dni_emp')->on('empleados');
            $table->dateTime('fecha_hora_sol');
            $table->dateTime('fecha_hora_inicio');
            $table->dateTime('fecha_hora_fin');
            $table->enum("tipo_sol", ["ASUNTOS_PROPIOS", "VACACIONES", "HORAS_COMPENSATORIAS"]);
            $table->enum("estado_sol", ["EN_ESPERA", "ACEPTADA", "RECHAZADA"]);
            $table->timestamps();
            $table->primary(array('dni_emp', 'id_sol'));
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
