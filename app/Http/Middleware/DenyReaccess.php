<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class DenyReaccess
{
    public function handle($request, Closure $next)
    {

        if (Session::has('is_granted')) {

          return redirect('/');

        } else {

          return $next($request);
        }

    }
}
