<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Helpers\User\AuthHelper;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Method untuk handle proses login & generate token JWT
     *
     * @author Wahyu Agung <wahyuagung26@email.com>
     *
     * @return void
     */
    public function login(AuthRequest $request)
    {
        /**
         * Menampilkan pesan error ketika validasi gagal
         * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');
        $login = AuthHelper::login($credentials['email'], $credentials['password']);

        if (!$login['status']) {
            return response()->failed($login['error'], 422);
        }

        return response()->success($login['data'], 'Login Success!');
    }

    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->failed(['Token Required'], 401);
        }

        $refresh = AuthHelper::refresh($token);

        if (!$refresh['status']) {
            return response()->failed($refresh['error'], 422);
        }

        return response()->success($refresh['data'], 'Refresh Success!');
    }

    /**
     * Mengambil profile user yang sedang login
     *
     * @return void
     */
    public function profile()
    {
        return response()->success(new UserResource(auth()->user()));
    }

    /**
     * Mengambil profile user yang sedang login
     *
     * @return void
     */
    public function logout()
    {

        $logout = AuthHelper::logout();

        if (! $logout['status']) {
            return response()->failed($logout['error'], 422);
        }

        return response()->success([], 'Logout Success!');
    }
}
