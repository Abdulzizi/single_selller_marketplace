<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TestEmail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Email Test Laravel',
            'body' => 'Ini adalah email percobaan dari Laravel menggunakan SMTP Gmail.'
        ];

        Mail::to('jawadazizi052@gmail.com')->send(new TestEmail($details));

        return response()->json(['message' => 'Email berhasil dikirim']);
    }
}
