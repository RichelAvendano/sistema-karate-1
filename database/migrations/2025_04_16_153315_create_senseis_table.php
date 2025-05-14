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
        Schema::create('senseis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dan')->nullable();
            $table->date('date_of_birth');
            $table->string('organization')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('dojo_id')->nullable()->constrained()->onDelete('set null'); // Un dojo tiene UN sensei
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senseis');
    }
};
