<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    public function authenticated(Request $request, $user)
    {
        //todo
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('throttle:3,1')->only('login'); // 3(maxAttempts).  // 1(decayMinutes)
    }

    protected function redirectTo( ) {
        if (Auth::check() && Auth::user()->role == 'Admin') {
            return('/Admin');
        }
        elseif (Auth::check() && Auth::user()->role == 'Manager') {
            return('/Manager');
        }
        elseif (Auth::check() && Auth::user()->role == 'Chef') {
            return('/Chef');
        }
        else {
            return('/Waiter');
        }
    }
}
