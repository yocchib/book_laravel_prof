<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // p218 taka
        $schedule->command('mail:send-daily-tweet-count-mail')
                    ->dailyAt('11:00');

        // 毎分        p209 taka
        // $schedule->command('sample-command')->everyMinute()
        //      ->emailOutputTo('taka@example.com');   // p211 taka

        // 毎時        p209 taka
        // $schedule->command('sample-command')->hourly();

        // 毎時8分     p209 taka
        // $schedule->command('sample-command')->hourlyAt(8);

        // 毎日        p209 taka
        // $schedule->command('sample-command')->daily();

        // 毎日13時    p209 taka
        // $schedule->command('sample-command')->dailyAt('13:00');

        // 毎日3:15(cron表記)   p209 taka
        // $schedule->command('sample-command')->cron('15 3 * * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
