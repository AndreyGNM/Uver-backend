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
        Schema::create('usuarioConductores', function (Blueprint $table) {
            $table->integer('cedula')->primary();
            $table->string('cuentaBancaria');
            $table->unsignedBigInteger('licencia');
            $table->integer('telefono');

            $table->foreign('telefono')->references('telefono')->on('usuarios');
            $table->foreign('licencia')->references('id')->on('catalogoLicencias');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarioConductores');
    }
};
