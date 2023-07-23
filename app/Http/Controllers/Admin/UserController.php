<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        // Retrieve all users from the 'users' table, paginated with 10 users per page
        $users = User::paginate(10);
        // Return the view with the user data
        return view('admin.users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        // Return the view for creating a new user
        return view('admin.users.create');
    }

    // Store a new user in the database
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        // Create a new user record in the 'users' table
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        // Redirect back to the users page with a success message
        return redirect('/admin/users')->with('message', 'User Created successfully');
    }

    // Show the form to edit a user
    public function edit(int $userId)
    {
        // Find the user with the given user ID
        $user = User::findOrFail($userId);
        // Return the view for editing the selected user
        return view('admin.users.edit', compact('user'));
    }

    // Update a user in the database
    public function update(Request $request, int $userId)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        // Update the user record in the 'users' table
        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        // Redirect back to the users page with a success message
        return redirect('/admin/users')->with('message', 'User Updated successfully');
    }

    // Delete a user from the database
    public function destroy(int $userId)
    {
        // Find the user with the given user ID
        $user = User::findOrFail($userId);
        // Delete the user record from the 'users' table
        $user->delete();
        // Redirect back to the users page with a success message
        return redirect('/admin/users')->with('message', 'User Deleted Successfully');
    }
}
