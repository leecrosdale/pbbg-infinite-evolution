<?php

namespace App\Console;

use App\Console\Commands\FiveMinuteTickCommand;
use App\Console\Commands\OneMinuteTickCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(OneMinuteTickCommand::class)
            ->everyMinute();

        $schedule->command(FiveMinuteTickCommand::class)
            ->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
