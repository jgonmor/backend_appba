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
            $table->id("id_marc");
            $table->dateTime('fecha_hora_marc');
            $table->enum("tipo_marc", ["ENTRADA", "SALIDA"]);
            $table->string('dni_emp', 9);
            $table->bigInteger('id_emp');
            // $table->foreign('dni_emp')->references('dni_emp')->on('empleados');
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
