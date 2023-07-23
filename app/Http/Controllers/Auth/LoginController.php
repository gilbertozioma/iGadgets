<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Handle the authenticated user's redirection after login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated()
    {
        // Check if the authenticated user has role_as '1' (admin)
        if (Auth::user()->role_as == '1') {
            // Redirect to the admin dashboard with a welcome message
            return redirect('admin/dashboard')->with('message', 'Welcome to Dashboard');
        } else {
            // Redirect to the default '/home' route with a success message
            return redirect('/home')->with('status', 'Logged In Successfully');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply 'guest' middleware to the login controller except the 'logout' method
        $this->middleware('guest')->except('logout');
    }
}
