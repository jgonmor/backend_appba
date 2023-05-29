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
            $table->string('dni', 9)->unique();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('nombre');
            $table->string('categoria');
            $table->unsignedBigInteger('departamento');
            // $table->foreign('departamento')->references('id')->on('departamentos');
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
