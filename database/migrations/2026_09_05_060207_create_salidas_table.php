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
        Schema::create('salidas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('agencia_id')->constrained('agencias')->onDelete('cascade');
        $table->foreignId('ruta_id')->constrained('rutas')->onDelete('cascade');
        $table->dateTime('fecha_hora_salida');
        $table->decimal('precio_final', 8, 2);
        $table->integer('asientos_totales');
        $table->integer('asientos_disponibles');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidas');
    }
};
