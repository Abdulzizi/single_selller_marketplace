<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use VPack\Vmail\Facades\VMail;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;
    // protected $vMail;


    public function __construct($email, $token)
    {
        // $this->vMail = new VMail();
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
