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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->enum("categoria", [
                "AUTORIDAD_PORTUARIA",
                "ESTACIONES_MARITIMAS",
                "PUESTO_INSPECCION_FRONTERIZO",
                "TOTAL_TERMINAL_INTERNACIONAL",
                "TERMINAL_TRAFICO_PESADO",
                "CAPITANIA_MARITIMA",
                "ADUANA",
                "APM_TERMINALS"
            ]);
            $table->string("nombre");
            $table->string("direccion");
            $table->string("latitud");
            $table->string("longitud");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
