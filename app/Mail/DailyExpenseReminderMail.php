<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class DailyExpenseReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    // Inject the user into the mailable
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Daily Reminder from Moneyflow')
            ->view('emails.daily_reminder')
            ->with([
                'user' => $this->user,
            ]);
    }
}
