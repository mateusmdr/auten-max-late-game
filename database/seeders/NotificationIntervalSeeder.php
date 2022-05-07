<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_intervals')->insert([
            ['minutes' => 5],
            ['minutes' => 10],
            ['minutes' => 15],
            ['minutes' => 20],
            ['minutes' => 30],
            ['minutes' => 45],
            ['minutes' => 60]
        ]);
    }
}
