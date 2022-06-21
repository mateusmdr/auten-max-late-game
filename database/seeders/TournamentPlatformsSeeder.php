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
            ['name' => 'Poker Stars', 'img_filename' => url('/images/pokerstars.png')],
            ['name' => 'Party Poker', 'img_filename' => url('/images/partypoker.png')],
            ['name' => 'GG Poker', 'img_filename' => url('/images/ggpoker.png')],
            ['name' => 'WPN', 'img_filename' => url('/images/wpn.png')]
        ]);
    }
}
