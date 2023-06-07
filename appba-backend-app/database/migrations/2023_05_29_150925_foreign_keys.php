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
        // Schema::table('nominas', function (Blueprint $table) {
        //     $table->foreign('empleado')->references('id')->on('empleados');
        // });

        // Schema::table('marcajes', function (Blueprint $table) {
        //     $table->foreign('empleado')->references('id')->on('empleados');
        // });
        // Schema::table('ausencia__empleados', function (Blueprint $table) {
        //     $table->foreign('id')->references('id')->on('empleados');
        // });

        // Schema::table('solicitudes', function (Blueprint $table) {
        //     $table->foreign('empleado')->references('id')->on('empleados');
        // });
        // Schema::table('departamentos', function (Blueprint $table) {
        //     $table->foreign('jefe')->references('id')->on('empleados');
        // });
        // Schema::table('empleados', function (Blueprint $table) {
        //     $table->foreign('departamento')->references('id')->on('departamentos');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('locations');
    }
};
