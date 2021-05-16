<?php

namespace App\Console;

use App\Console\Commands\FifthBillingJob;
use App\Console\Commands\FirstBillingJob;
use App\Console\Commands\ThirdBillingJob;
use App\Console\Commands\FourthBillingJob;
use App\Console\Commands\SecondBillingJob;
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
        //
        FirstBillingJob::class,
        SecondBillingJob::class,
        ThirdBillingJob::class,
        FourthBillingJob::class,
        FifthBillingJob::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('first:billing')->everyMinute();
        $schedule->command('second:billing')->dailyAt('12:00')->runInBackground();
        $schedule->command('third:billing')->dailyAt('12:00')->runInBackground();
        $schedule->command('fourth:billing')->dailyAt('12:00')->runInBackground();
        $schedule->command('fifth:billing')->dailyAt('12:00')->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}