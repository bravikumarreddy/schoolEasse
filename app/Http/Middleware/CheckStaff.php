<?php

namespace App\Http\Middleware;

use Closure;

class CheckStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if ($user->hasRole('teacher') || $user->hasRole('admin')  || $user->hasRole('librarian') || $user->hasRole('accountant') || $user->hasRole('librarian')  ) {
            return $next($request);
        }
        return redirect('home');
    }
}
