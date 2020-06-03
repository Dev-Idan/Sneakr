<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class MainAccess
{
    public function handle($request, Closure $next)
    {

        if (Session::has('is_granted')) {

          return $next($request);

        } else {

          return redirect('access');
        }

    }
}
