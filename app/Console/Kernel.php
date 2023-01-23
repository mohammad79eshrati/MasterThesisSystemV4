<?php

namespace App\Console;

use App\Console\Commands\ClearResetTokens;
use App\Console\Commands\NotifyUsers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NotifyUsers::class,
        ClearResetTokens::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('reset-tokens:clear')->everyFifteenMinutes();
        $schedule->command('notifications:work')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
         $this->load(__DIR__ . "/Commands");

    }
}
