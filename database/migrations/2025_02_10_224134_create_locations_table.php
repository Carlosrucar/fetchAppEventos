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
            $table->string('nombre');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('codigo_postal');
            $table->decimal('latitud', 10, 8);
            $table->decimal('longitud', 11, 8);
            $table->integer('capacidad')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado_lugar', ['activo', 'inactivo', 'mantenimiento'])
                  ->default('activo');
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