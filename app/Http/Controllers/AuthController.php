<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function login(Request $request)
{
    // Validate the user input
    $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
    ]);

    // Attempt to log the user in
    if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
        // If login successful, check if the user has an active session
        if (Auth::check()) {
            // If the user has an active session, redirect them to the home page
            return redirect('/home');
        } else {
            // If the user doesn't have an active session, redirect them to the end page
            return redirect('/end');
        }
    } else {
        // If login fails, redirect back to the login form with an error message
        return redirect('/login')->with('error', 'Invalid username or password');
    }
}


    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        // Validate the user input
        $this->validate($request, [
            'username' => 'required|unique:users|max:30|min:6',
            'password' => 'required|max:30|min:6|confirmed',
        ]);

        // Create a new user record
        $user = new User;
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Log the user in
        Auth::login($user);

        // Redirect to the home page
        return redirect('/home');
    }
}