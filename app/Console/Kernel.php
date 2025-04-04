<?php

namespace App\Console;

use App\Http\Controllers\Admin\PackageAdminController;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\Admin\PayWithdrawAdminController;
use App\Http\Controllers\CompensationController;
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
        $schedule->call(function () {
            $controller = new CompensationController();
            $controller->dailyCron();
        })->daily();

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
