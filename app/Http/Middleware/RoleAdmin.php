<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleAdmin
{
    public function handle($request, Closure $next)
    {
        if($user = Auth::user())
            if($user->hasRole('admin'))
                return $next($request);

        abort(403);
        return false;
    }
}
