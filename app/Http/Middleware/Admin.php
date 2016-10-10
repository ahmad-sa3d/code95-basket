<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class Admin
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

        if( $request->user()->is_admin )
            return $next($request);
        else
            return Response::view( 'errors.custom', [ 'message' => 'Un Authorized Access', 'title'=>'Un Authorized' ], 403 );
    }
}
