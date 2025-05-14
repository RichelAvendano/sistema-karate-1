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
        Schema::create('event_sensei', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('sensei_id')->constrained()->onDelete('cascade');
            $table->primary(['event_id', 'sensei_id']); // Clave primaria compuesta
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_sensei');
    }
};
