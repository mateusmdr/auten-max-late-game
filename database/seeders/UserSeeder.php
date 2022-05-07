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
            'name' => 'Usuário Teste',
            'cpf' => env('TEST_USER_CPF'),
            'phone' => env('TEST_USER_PHONE'),
            'email' => env('TEST_USER_EMAIL'),
            'password' => Hash::make(env('TEST_USER_PASSWORD')),
            'is_admin' => true,
            'email_verified_at' => now()
        ]);
    }
}
