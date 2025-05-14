<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('max_participants'); // 🔥 Elimina el campo antiguo
            $table->integer('max_dojo')->nullable(); // 🏯 Nuevo campo
            $table->integer('max_sensei')->nullable(); // 🥋 Nuevo campo
            $table->integer('max_student')->nullable(); // 🎓 Nuevo campo
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('max_participants')->nullable(); // 🔙 Recupera si se hace rollback
            $table->dropColumn(['max_dojo', 'max_sensei', 'max_student']); // 💥 Elimina los nuevos si se revierte
        });
    }
};

