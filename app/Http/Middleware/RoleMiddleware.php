<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Gunakan di route: ->middleware('role:admin') atau 'role:admin,editor'
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        if ($user->hasRole($roles)) {
            return $next($request);
        }

        abort(403, 'You do not have permission to access this resource.');
    }
}
