<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AppCustomPreperation
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
        // Log User Activity
        if( Auth::check() )
        {
            $expire = Carbon::now()->addMinutes(5);
            Cache::put( 'user_online_'. Auth::id(), true, $expire );
        }

        // Share Session_Notification
        $notification = Session::has('notification') ? Session::pull('notification') : null;
        View::share( 'session_notification', $notification );
        return $next($request);
    }
}
