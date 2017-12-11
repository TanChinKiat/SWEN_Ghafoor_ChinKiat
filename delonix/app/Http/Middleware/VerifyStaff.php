<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class VerifyStaff
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


    if (($request->session()->has("session_hash"))&&($request->session()->has("session_user"))){

      return $next($request);

    }else{

      return redirect('/');
    }





    }


}
