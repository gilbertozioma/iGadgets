<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply 'auth' middleware to ensure only authenticated users can access verification routes.
        $this->middleware('auth');

        // Apply 'signed' middleware to verify the email confirmation link's signature.
        // This prevents unauthorized users from using someone else's email confirmation link.
        $this->middleware('signed')->only('verify');

        // Apply 'throttle' middleware to limit the rate of email verification attempts.
        // In this case, a user can attempt email verification 6 times every 1 minute.
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
