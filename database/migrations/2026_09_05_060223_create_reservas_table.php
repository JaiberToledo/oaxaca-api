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
        Schema::create('reservas', function (Blueprint $table) {
        $table->id();
        $table->string('codigo_reserva')->unique();
        $table->foreignId('salida_id')->constrained('salidas')->onDelete('cascade');
        $table->string('cliente_nombre');
        $table->string('cliente_email');
        $table->string('cliente_telefono');
        $table->integer('num_asientos');
        $table->decimal('monto_total', 8, 2);
        $table->decimal('comision_plataforma', 8, 2);
        $table->enum('estado_pago', ['pendiente', 'pagado', 'cancelado'])->default('pendiente');
        $table->string('pasarela')->nullable();
        $table->string('transaccion_id')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
