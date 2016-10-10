<?php

namespace App\Http\Middleware;

use Closure;

class Captcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $option = null )
    {
        // On Renew Middleware thats mean it passess Capatcha Validation, so this check is at first
        if( $option == 'renew' )
        {
            // Only Allow Ajax Requests
            if( !$request->ajax() )
                return \Response::make( 'Unauthorized', 201 );
        }

        // Check if Valid Request
        if( ! \App\Services\Images\Captcha::hasCode() )
            return \App::abort( '404' );

        return $next($request);
    }

}
