<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the user's profile page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Return the view 'frontend.users.profile'.
        return view('frontend.users.profile');
    }

    /**
     * Update user details for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserDetails(Request $request)
    {
        // Validate the request data.
        $request->validate([
            'username' => ['required', 'string'],
            'phone' => ['required', 'digits:10'],
            'pin_code' => ['required', 'digits:6'],
            'address' => ['required', 'string', 'max:499'],
        ]);

        // Find the authenticated user.
        $user = User::findOrFail(Auth::user()->id);

        // Update the user's name.
        $user->update([
            'name' => $request->username
        ]);

        // Update or create the user details (phone, pin_code, address).
        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
            ]
        );

        // Redirect back with a success message.
        return redirect()->back()->with('message', 'User Profile Updated');
    }

    /**
     * Show the change password form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function passwordCreate()
    {
        // Return the view 'frontend.users.change-password'.
        return view('frontend.users.change-password');
    }

    /**
     * Change the user's password for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        // Validate the request data.
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        // Check if the current password matches the user's old password.
        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus) {

            // Update the user's password.
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            // Redirect back with a success message.
            return redirect()->back()->with('message', 'Password Updated Successfully');
        } else {

            // If the current password does not match the old password, redirect back with an error message.
            return redirect()->back()->with('message', 'Current Password does not match with Old Password');
        }
    }
}
