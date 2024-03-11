<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Task;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Implement Code For getting the data within 30 days that has been remove and get all ids
     * After Getting All ids it will be pass to where in to delete 
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $taskRemoveIds = Task::where(['removed' => 1])->whereRaw('DATEDIFF(removed_at, now()) >= 30', [])->pluck('id');
            Task::whereIn('id', $taskRemoveIds)->delete();
        })->everyMinute();
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
