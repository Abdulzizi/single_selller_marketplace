<?php

namespace App\Helpers;

use App\Jobs\SendResetPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetHelper
{
    public static function sendResetLink($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        if (!$user) {
            return false;
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'created_at' => Carbon::now()]
        );

        dispatch(new SendResetPasswordEmail($email, $token));

        return true;
    }

    public static function resetPassword($email, $token, $password)
    {
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record || !Hash::check($token, $record->token)) {
            return false;
        }

        DB::table('users')->where('email', $email)->update([
            'password' => Hash::make($password),
        ]);

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return true;
    }
}
