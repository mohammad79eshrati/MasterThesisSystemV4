<?php

namespace App\Mail;

use App\Models\Defense;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefenseSuggestion extends Mailable
{
    use Queueable, SerializesModels;

    public Defense $defense;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Defense $defense)
    {
        $this->user = $user;
        $this->defense = $defense;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown("email.defense_suggestion");
    }
}
