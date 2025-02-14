<?php

use App\Jobs\SendBulkEmailJob;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-bulk-email', function () {
    $details = [
        'emails' => [
            "jawadazizi052@gmail.com",
            "azizijamal005@gmail.com"
        ],
        'subject' => 'Redis Queue Test',
        'message' => 'This is a test email via Redis queue'
    ];

    dispatch(new SendBulkEmailJob($details));

    return response()->json(['message' => 'Bulk email job dispatched via Redis!']);
});
