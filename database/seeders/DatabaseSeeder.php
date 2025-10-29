<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

   User::firstOrCreate(
     ['email' => 'test@example.com'], // Busca por este email
     [                                // Si no lo encuentra, lo crea con estos datos:
         'name' => 'Test User',
         'password' => \Illuminate\Support\Facades\Hash::make('password'), // Asegúrate de asignar una contraseña
         
     ]
 );
        $this->call([
        AdminUserSeeder::class,
       PeliculasSeeder::class,
        ]);
        
    }
}
