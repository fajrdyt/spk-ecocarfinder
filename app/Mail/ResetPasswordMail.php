<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $name;

    public function __construct($resetUrl, $name)
    {
        $this->resetUrl = $resetUrl;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Reset Password EcoCarFinder')
                    ->view('emails.reset-password');
    }
}