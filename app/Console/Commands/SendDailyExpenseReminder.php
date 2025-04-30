<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyExpenseReminderMail;
use Illuminate\Support\Facades\Log;
class SendDailyExpenseReminder extends Command
{
    protected $signature = 'email:daily-expense-reminder';
    protected $description = 'Send daily expense reminder email to all users';

    // public function handle()
    // {
    //     $users = User::all();
    //     foreach ($users as $user) {
    //         Mail::to($user->email)->send(new DailyExpenseReminderMail($user));
    //     }
        

    //     $this->info('Daily expense reminder emails sent successfully.');
    // }
    

    public function handle()
    {
        Log::info('📧 Running SendDailyExpenseReminder command...');
    
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new DailyExpenseReminderMail($user));
        }
    
        $this->info('✅ Daily expense reminder emails sent.');
    }
    

}
