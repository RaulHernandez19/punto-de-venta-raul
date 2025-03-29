<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Usar un dominio de ejemplo estándar
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'), // Contraseña genérica para desarrollo
            ]
        );

        $admin->assignRole('admin');
    }
}
