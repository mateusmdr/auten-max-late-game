<?php

namespace App\Console;

use App\Jobs\SyncPayments;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->command('auth:clear-resets')
            ->everySixHours()
            ->sendOutputTo(storage_path('/logs/laravel.log'), true);
        
        $schedule->command('model:prune')
            ->daily()
            ->sendOutputTo(storage_path('/logs/laravel.log'), true);

        $schedule->job(new SyncPayments)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
