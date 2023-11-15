<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        $redirectRoute = 'dashboard'; // Default redirect route

    switch ($role) {
        case 'user':
            $redirectRoute = 'user/dashboard';
            break;
        case 'agency':
            $redirectRoute = 'agency/dashboard';
            break;
        case 'admin':
            $redirectRoute = 'admin/dashboard';
            break;
        // Add more cases as needed for other roles

        default:
            // Handle any unexpected roles or set a default route
            break;
    }

    if ($request->user()->role !== $role) {
        return redirect($redirectRoute);
    }
    return $next($request);
    }
}
