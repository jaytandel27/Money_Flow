<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendDailyExpenseReminder::class,
    ];

    // protected function schedule(Schedule $schedule)
    // {
    //     Log::info('📅 schedule() method is running...');
        
    //     $schedule->command('email:daily-expense-reminder')
    //     ->everyMinute()
    //     ->evenInMaintenanceMode()
    //     ->withoutOverlapping();

    // }
    protected function schedule(Schedule $schedule)
    {
        // Ensure you're using the correct timezone for scheduling
        $timeInKolkata = Carbon::now('Asia/Kolkata')->format('H:i');

        Log::info("📅 Current time in Kolkata: {$timeInKolkata}");

        $schedule->command('email:daily-expense-reminder')
            ->everyMinute()  // Time in Kolkata
            ->evenInMaintenanceMode()
            ->withoutOverlapping();
        }
    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
