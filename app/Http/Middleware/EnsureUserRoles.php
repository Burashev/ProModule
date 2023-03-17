<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!collect($roles)->contains(auth()->user()->role_id->value)) {
            flash()->error('Вы не имеете доступа к данной странице');
            return redirect()->back();
        }

        return $next($request);
    }
}
