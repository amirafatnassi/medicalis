<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;

    /**
     * Create a new message instance.
     *
     * @param  Patient  $patient
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirm your email address')
            ->markdown('emails.confirmation', [
                'user' => $this->user,
                'url' => route('confirmation', ['token' => $this->user->verification_token]),
            ]);
    }
}
