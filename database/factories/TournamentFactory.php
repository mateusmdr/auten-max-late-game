<?php

namespace Database\Factories;

use App\Models\TournamentPlatform;
use App\Models\TournamentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'prize'=> rand(0,350),
            'min_buy_in'=> rand(0,50),
            'max_buy_in'=> rand(50,100),
            'date' => $this->faker->date(),
            'subscription_begin_at' => $this->faker->time(),
            'subscription_end_at' => $this->faker->time(),
            'is_approved'=> $this->faker->boolean(25),

            'tournament_type_id' => TournamentType::all()->random()->id,
            'tournament_platform_id' => TournamentPlatform::all()->random()->id,
        ];
    }
}
