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
        Schema::create('dojo_event', function (Blueprint $table) {
            $table->foreignId('dojo_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->primary(['dojo_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dojo_event');
    }
};
