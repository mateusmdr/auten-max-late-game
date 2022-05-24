<?php

namespace Database\Factories;

use App\Models\User;
use App\Helpers\DBTypes;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = DBTypes::NOTIFICATION_TYPES[rand(0,2)];
        return [
            'datetime' => rand(0, 1) === 1 ? now()->addDays(rand(1,85)) : now()->subDays(rand(1,85)),
            'description' => $this->faker->text(),
            'type' => $type,

            'user_id' => User::all()->where('is_admin',false)->random(),
            'tournament_id' => $type == 'tournament' ? Tournament::all()->where('is_approved',true)->random() : null,
        ];
    }
}
