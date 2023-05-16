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
        Schema::create('empleados', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('dni_emp', 9)->unique();
            $table->date('fecha_inicio_emp');
            $table->date('fecha_fin_emp')->nullable();
            $table->string('nombre_emp');
            $table->string('categoria_emp');
            $table->bigInteger('id_dep');
            $table->foreign('id_dep')->references('id_dep')->on('departamentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
