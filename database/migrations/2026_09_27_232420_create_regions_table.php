<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->string('color')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Agregamos el campo region_id a agencias de una vez aquí asegurando el orden
        Schema::table('agencias', function (Blueprint $table) {
            $table->foreignId('region_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('regiones')
                  ->onDelete('set null');
        });

        // Agregamos el campo region_id a rutas de una vez aquí
        Schema::table('rutas', function (Blueprint $table) {
            $table->foreignId('region_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('regiones')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('rutas', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
        });

        Schema::table('agencias', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
        });

        Schema::dropIfExists('regiones');
    }
};