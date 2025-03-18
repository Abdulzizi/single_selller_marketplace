<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next, $roles = '')
    {
        try {
            $userModel = JWTAuth::parseToken()->authenticate();
            $userToken = JWTAuth::parseToken()->getPayload()->get('user');

            $updatedDb = new DateTime($userModel['updated_security']);
            $updatedToken = new DateTime($userToken['updated_security']);

            if ($updatedDb > $updatedToken) {
                return response()->json(['message' => 'Terdapat perubahan pengaturan keamanan, silahkan login ulang'], Response::HTTP_FORBIDDEN);
            }

            if (!empty($roles) && !$userModel->isHasRole($roles)) {
                return response()->json(['message' => 'Anda tidak memiliki credential untuk mengakses data ini'], Response::HTTP_FORBIDDEN);
            }
        } catch (TokenExpiredException $e) {
            try {
                $newToken = JWTAuth::refresh(JWTAuth::getToken());

                // Attach new token in the response header
                return $next($request)->header('Authorization', 'Bearer ' . $newToken);
            } catch (JWTException $refreshException) {
                return response()->json(['message' => 'Token expired, please login again'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Invalid token'], Response::HTTP_FORBIDDEN);
        } catch (Exception $e) {
            return response()->json(['message' => 'Silahkan login terlebih dahulu. ' . $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
