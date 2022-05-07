<?php

namespace Database\Seeders;

use Database\Factories\PaymentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentFactory::new()
            ->count(25)
            ->create();
    }
}
