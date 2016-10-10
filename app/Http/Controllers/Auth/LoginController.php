<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * Replaced By RedirectPath Method
     *
     * @var string
     */
    // protected $redirectTo = '/admin';

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Authentication Field
     * @return String Field To Authenticate User With, Default: email
     */
    public function username()
    {
       return 'username';
    }

    
    /**
     * Path To Redirect User To After Login Successfully
     * @return [type] [description]
     */
    public function redirectPath()
    {
        $this->makeSuccessNotification( 'Welcome Back ' . $this->guard()->user()->username );

        return ( $this->guard()->user()->is_admin ) ? '/admin' : '/';

    }


}
