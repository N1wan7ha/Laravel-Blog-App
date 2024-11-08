<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Validate incoming fields
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Logged in successfully!');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'loginname' => 'The provided credentials do not match our records.',
        ])->onlyInput('loginname');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // Regenerate session to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }

    public function register(Request $request)
    {
        // Validate incoming fields
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:100']
        ]);

        // Hash the password before storing
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        
        // Create the user
        $user = User::create($incomingFields);

        // Log the user in
        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful! Logged in automatically.');
    }
}
