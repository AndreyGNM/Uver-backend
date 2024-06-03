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
        Schema::create('viajes', function (Blueprint $table) {
            
            $table->id();
            $table->integer('conductor');
            $table->integer('pasajero');
            $table->string('ubicacionPasajero');
            $table->string('ubicacionDestino');
            $table->boolean('estado');

            $table->foreign('conductor')->references('cedula')->on('usuarioConductores');
            $table->foreign('pasajero')->references('telefono')->on('usuarios');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
