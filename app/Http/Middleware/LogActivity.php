<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        // dd($request->all());
        $response = $next($request);

        // Ambil informasi request dan response
        $user = auth()->user();
        $userId = $user ? $user->id : null;

        $logData = [
            'user_id'        => $userId,
            'method'         => $request->method(),
            'url'            => $request->fullUrl(),
            'ip_address'     => $request->ip(),
            'user_agent'     => $request->header('User-Agent'),
            'request_headers' => json_encode($request->headers->all()),
            'request_body'   => json_encode($request->all()),
            'response_body'  => json_encode($response->getContent()),
            'status_code'    => $response->status(),
        ];

        // Simpan ke file log Laravel
        Log::channel('daily')->info('Activity Log:', $logData);

        // Simpan ke MongoDB jika koneksi tersedia
        try {
            if (DB::connection('mongodb')) {
                ActivityLog::create($logData);
            }
        } catch (\Exception $e) {
            Log::error('MongoDB Connection Error: ' . $e->getMessage());
        }

        return $response;
    }
}
