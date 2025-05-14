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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kyu')->nullable();
            $table->date('date_of_birth');
            $table->string('organization')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('sensei_id')->nullable()->constrained()->onDelete('set null'); // Un estudiante pertenece a UN sensei
            $table->foreignId('dojo_id')->nullable()->constrained()->onDelete('set null'); // Un estudiante pertenece a UN dojo
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });                
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
