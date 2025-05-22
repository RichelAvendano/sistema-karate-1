<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Seeder
{
    public function run()
    {
        // Insertar usuario base
        $userId = DB::table('users')->insertGetId([
            'email' => 'richeljeremias@gmail.com',
            'password' => Hash::make('mario0312'), // Encripta la clave
            'role' => 'administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insertar SuperAdmin vinculado al usuario
        DB::table('super_admins')->insert([
            'user_id' => $userId, // Relación con el usuario
            'name' => 'Richel Avendano',
            
        ]);
    }
}
