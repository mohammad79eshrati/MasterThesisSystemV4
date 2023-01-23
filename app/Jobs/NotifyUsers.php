<?php

namespace App\Jobs;

use App\Mail\DefenseSuggestion;
use App\Models\Defense;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $defense;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Defense $defense)
    {
        $this->defense = $defense;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            $sim = similarityAnalyzer($this->defense, $user);
            if ($sim > 50 || $user->interests->contains($this->defense->subject)) {
                if ($user->phone_notif) {
                    sendSMS($user, $this->defense);
                    Log::info("sending SMS to : " . $user->phone);
                }
                if ($user->email_notif) {
                    Log::info("sending Email to : " . $user->email);
                    Mail::to($user->email)->send(new DefenseSuggestion($user, $this->defense));
                }
            }
        }
    }
}
