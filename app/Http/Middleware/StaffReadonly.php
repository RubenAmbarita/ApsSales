<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StaffReadonly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->roles === 'STAFF') {
            $routeName = $request->route() ? $request->route()->getName() : '';
            $method = strtoupper($request->method());

            // Block mutation methods
            $isMutationMethod = !in_array($method, ['GET', 'HEAD', 'OPTIONS']);

            // Block create/edit forms even though they are GET
            $isFormRoute = $routeName && (str_ends_with($routeName, '.create') || str_ends_with($routeName, '.edit'));

            if ($isMutationMethod || $isFormRoute) {
                abort(403, 'Akses terbatas: STAFF hanya memiliki hak baca.');
            }
        }

        return $next($request);
    }
}