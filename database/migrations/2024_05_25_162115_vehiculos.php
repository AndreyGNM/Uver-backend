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
        Schema::create('vehiculos', function (Blueprint $table) {
            
            $table->string('placa')->primary();
            $table->unsignedBigInteger('modelo');
            $table->integer('propietario');
            $table->integer('cantidadPasajeros');

            $table->foreign('modelo')->references('id')->on('catalogoModelos');
            $table->foreign('propietario')->references('cedula')->on('usuarioConductores');

        
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
