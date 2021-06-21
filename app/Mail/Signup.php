<?php

namespace App\Mail;

use App\Signup as AppSignup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Signup extends Mailable
{
    use Queueable, SerializesModels;
    public $signup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppSignup $signup)
    {
        $this->signup = $signup;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.signup-markdown');
    }
}
