<?php

namespace App\Jobs;

use App\Mail\ConfirmMail;
use App\Mail\ReminderMail;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct()
    {
        $sendMailTo = Event::where('starting_date', '>', Carbon::now()->addDay()->toDateString())->where('reminder_sent', '=', '0')->has('users')->get();

        $this->data = $sendMailTo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        foreach ($this->data as $sendTo){

            foreach ($sendTo->users as $user) {
                $email = new ReminderMail($user->email, $sendTo);
                Mail::to($user->email)->send($email);
            }

            Event::findOrFail($sendTo->id)->update([
                'reminder_sent' => true
            ]);
        }
    }
}
