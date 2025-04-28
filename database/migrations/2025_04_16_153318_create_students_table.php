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
            $table->foreignId('sensei_id')->constrained()->cascadeOnDelete(); // Un estudiante pertenece a UN sensei
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
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
