<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Reset Password')
            ->markdown('emails.reset-password')
            ->with([
                'email' => $this->email,
                'token' => $this->token,
                'resetUrl' => url('/reset-password?token=' . $this->token . '&email=' . $this->email),
            ]);
    }
}
