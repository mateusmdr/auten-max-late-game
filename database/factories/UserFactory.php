<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            
            'is_admin'=> false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
