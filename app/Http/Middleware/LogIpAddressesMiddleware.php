<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

use App\Models\IPLog;

class LogIpAddressesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current request's path
        $currentPath = $request->path();

        // Check if the current path matches "/simplinamdhari"
        if (
            $currentPath === 'simplinamdhari' ||
            str_contains($currentPath, 'set_active') ||
            str_contains($currentPath, 'set_inactive')
        ) {
            $ipAddress = $request->ip();
            $deviceName = $request->userAgent();

            // Log the IP address in a database table
            $ipLog = IPLog::where('ip_address', $ipAddress)->first();
            if($ipLog) {
                $ipLog->updated_at = now();

                $ipLog->saveQuietly();
            } else {
                $ipLog = new IPLog([
                    'device_name' => $deviceName,
                    'ip_address' => $ipAddress,
                    'active' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $ipLog->save();
            }
        }
        return $next($request);
    }
}
