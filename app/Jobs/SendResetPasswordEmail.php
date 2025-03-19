<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use VPack\Vmail\Jobs\SendEmailJob;

class SendResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $token;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            SendEmailJob::dispatch($this->email, 'Reset Password', 'emails.reset-password', [
                'email' => $this->email,
                'token' => $this->token,
                'resetUrl' => url('/reset-password?token=' . $this->token . '&email=' . $this->email),
            ], []);

            // Fallback to Laravel Mail if VMail fails
        } catch (\Exception $e) {
            Mail::to($this->email)->send(new ResetPasswordMail($this->email, $this->token));
        }
    }
}
