<?php

use App\Http\Controllers\ClientViews\LandingPageController;
use App\Jobs\SendBulkEmailJob;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email-test', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('jawadazizi052@gmail.com')
            ->subject('Test Email');
    });
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

// Reset Password
Route::view('/reset-password', 'auth.reset-password');

// Send view
Route::get('/products', [LandingPageController::class, 'index']);
