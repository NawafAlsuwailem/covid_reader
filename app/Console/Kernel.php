<?php

namespace App\Console;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\WorldWideStatsController;
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
        // schedulers to update covid data
        $countryAPI= new CountryController();
        $worldWideAPI = new WorldWideStatsController();
        $schedule->call($countryAPI->getAll(true))->everyFourMinutes();
        $schedule->call($worldWideAPI->get(true))->everyFourMinutes();

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
