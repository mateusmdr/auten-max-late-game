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
            TournamentPlatformsSeeder::class,
            TournamentTypesSeeder::class,
        ]);

        if(env('APP_DEBUG', false)) {
            $this->call([
                UserSeeder::class,
                TournamentSeeder::class,
                NotificationSeeder::class,
            ]);
        }
    }
}
