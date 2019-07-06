<?php

namespace Modules\MultiTenant\Http\Middleware;

use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        MultiTenant::set($user->tenant);
        return $next($request);
    }
}
