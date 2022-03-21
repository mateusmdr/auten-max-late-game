<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password'=> Hash::make($this->faker->password()),
            'name'=> $this->faker->name(),
            'identification_type'=> 'CPF',
            'identification_value'=> $this->faker->cpf(false),
            'phone'=> $this->faker->cellphone(false),
            'is_verified'=> false,
            'verified_at'=> null,
            
            'is_admin'=> false,
        ];
    }
}
