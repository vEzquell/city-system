<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (
            !$request->user() ||
            $request->user()->role !== 'super_admin' ||
            $request->user()->status !== 'active'
        ) {
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}
