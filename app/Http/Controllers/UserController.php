<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all(); // Get all users
        return view('users.index', compact('users')); // Return the view with users
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Return the edit view with the user data
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required' // Validate the role field
        ]);

        $user->update(['role' => $request->role]); // Update the user's role

        return redirect()->route('users'); // Redirect back to the users list
    }

}
