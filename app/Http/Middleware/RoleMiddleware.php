<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class RoleMiddleware extends BaseMiddleware
{
    /**
     * Middleware untuk mengecek permission user ketika melakukan request ke salah satu routes
     * Pada saat membuat sebuah routes, tambahkan hak akses apa yang boleh mengakses endpoint ini
     *
     * Contohnya : Route::get('/users', [UserController::class, 'index'])->middleware(['auth.api','role:user_view']);
     *
     * Routes di atas hanya dapat diakses jika request dilengkapi dengan token JWT dan user memiliki akses "user_view"
     *
     * @author Wahyu Agung <wahyuagung26@email.com>
     */
    public function handle($request, Closure $next, $roles)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            // Cek jika user tidak mempunyai akses, tolak request ke endpoint yg diminta
            if (! $user->isHasRole($roles)) {
                return response()->failed(['Anda tidak memiliki credential untuk mengakses data ini'], 403);
            }

        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->failed(['Token yang anda gunakan tidak valid'], 403);
            } elseif ($e instanceof TokenExpiredException) {
                return response()->failed(['Token anda telah kadaluarsa, silahkan login ulang'], 403);
            } else {
                return response()->failed($e->getMessage());
            }
        }

        return $next($request);
    }
}
