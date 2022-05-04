<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_plans')->insert([
            ['period' => 'monthly', 'name' => 'Mensal', 'price' => 29.99],
            ['period' => 'biannual', 'name' => 'Semestral', 'price' => 119.99],
            ['period' => 'yearly', 'name' => 'Anual', 'price' => 199.99],
        ]);
    }
}
