<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TournamentPlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tournament_platforms')->insert([
            ['name' => 'Poker Stars', 'img_filename' => 'unknown'],
            ['name' => 'Party Poker', 'img_filename' => 'unknown'],
            ['name' => 'GG Poker', 'img_filename' => 'unknown'],
            ['name' => 'WPN', 'img_filename' => 'unknown']
        ]);
    }
}
