<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditLogMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $action = null): Response
    {
        // Lanjutkan request dulu
        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);

        try {
            // Hanya catat jika user login
            $user = $request->user();

            if ($user) {
                $route = $request->route();

                // Kita ambil model binding pertama (kalau ada), misalnya Post dari /posts/{post}
                $auditable = null;
                $routeParams = $route?->parameters() ?? [];

                foreach ($routeParams as $param) {
                    if (is_object($param) && method_exists($param, 'getKey')) {
                        $auditable = $param;
                        break;
                    }
                }

                AuditLog::create([
                    'user_id'       => $user->id,
                    'action'        => $action ?: ($route?->getName() ?? $request->method()),
                    'auditable_type'=> $auditable ? get_class($auditable) : null,
                    'auditable_id'  => $auditable?->getKey(),
                    'description'   => sprintf(
                        '%s %s mengakses %s',
                        $user->name,
                        $action ?: ($route?->getName() ?? $request->method()),
                        $request->path()
                    ),
                    'ip_address'    => $request->ip(),
                    'user_agent'    => $request->userAgent(),
                    'url'           => $request->fullUrl(),
                    'method'        => $request->method(),
                ]);
            }
        } catch (\Throwable $e) {
            // Jangan sampai error logging merusak aplikasi utama
            // Bisa ditulis ke log biasa jika mau:
            // \Log::warning('AuditLog error: '.$e->getMessage());
        }

        return $response;
    }
}