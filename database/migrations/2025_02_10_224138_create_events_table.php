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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('imagen')->nullable();
            $table->integer('capacidad')->nullable();
            $table->enum('estado', ['programado', 'en_curso', 'finalizado', 'cancelado'])
                  ->default('programado');
            $table->timestamps();
        });

        // Tabla pivote para registros de usuarios en eventos
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('estado', ['pendiente', 'confirmado', 'cancelado'])
                  ->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }
};