<?php

namespace Database\Factories;

use App\Models\User;
use App\Helpers\DBTypes;
use App\Models\PaymentPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'datetime' => now(),
            'price' => rand(1,300),
            'payment_method' => DBTypes::PAYMENT_METHODS[rand(0,1)],
            'payment_plan_id' => PaymentPlan::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
