<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PaymentPlansSeeder::class,
            NotificationIntervalSeeder::class
        ]);

        if(env('APP_DEBUG', false)) {
            $this->call([
                UserSeeder::class,
                TournamentPlatformsSeeder::class,
                TournamentTypesSeeder::class,
                PaymentSeeder::class,
            ]);
        }
    }
}
