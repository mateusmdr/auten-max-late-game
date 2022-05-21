<?php

namespace Database\Seeders;

use Database\Factories\TournamentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TournamentFactory::new()
            ->count(40)
            ->create();
    }
}
