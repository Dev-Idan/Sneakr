<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class UserGuard
{

    public function handle($request, Closure $next)
    {
        if (! Session::has('user_id')) {
          return $next($request);
        } else {
          return redirect('');
        }

    }
}
