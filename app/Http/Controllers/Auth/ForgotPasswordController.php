<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\PasswordResetHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if (!PasswordResetHelper::sendResetLink($request->email)) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Link reset password telah dikirim ke email Anda.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!PasswordResetHelper::resetPassword($request->email, $request->token, $request->password)) {
            return response()->json(['message' => 'Token tidak valid atau telah kadaluarsa'], 400);
        }

        return view('auth.reset-success');
    }
}
