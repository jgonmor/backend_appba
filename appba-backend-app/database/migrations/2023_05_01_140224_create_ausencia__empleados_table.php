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
        Schema::create('ausencia__empleados', function (Blueprint $table) {
            $table->string('dni_emp', 9)->primary();
            $table->foreign('dni_emp')->references('dni_emp')->on('empleados');
            $table->integer('vacaciones_totales');
            $table->integer('asuntos_propios_totales');
            $table->integer('horas_compensatorias_totales');
            $table->integer('horas_compensatorias_cogidas');
            $table->integer('vacaciones_cogidas');
            $table->integer('asuntos_propios_cogidos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencia__empleados');
    }
};
