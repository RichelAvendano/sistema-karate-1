<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day'); // ✅ Día de la semana (Ejemplo: "Lunes", "Martes")
            $table->time('start_time'); // ✅ Hora de inicio
            $table->time('end_time'); // ✅ Hora de fin
            $table->string('class_type')->nullable(); // ✅ Tipo de clase (Ejemplo: "Karate avanzado")
            $table->timestamps();
            // ✅ Definir las claves foráneas
            $table->foreignId('dojo_id')->constrained()->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
