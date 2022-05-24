<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()
            ->count(20)
            ->create();
        
        User::create([
            'name' => 'Cliente Teste',
            'cpf' => env('TEST_USER_CPF'),
            'phone' => env('TEST_USER_PHONE'),
            'email' => 'cliente@teste.com',
            'password' => Hash::make(env('TEST_USER_PASSWORD')),
            'is_admin' => false,
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Admin Teste',
            'cpf' => env('TEST_ADMIN_CPF'),
            'phone' => env('TEST_ADMIN_PHONE'),
            'email' => 'admin@teste.com',
            'password' => Hash::make(env('TEST_ADMIN_PASSWORD')),
            'is_admin' => true,
            'email_verified_at' => now()
        ]);
    }
}
