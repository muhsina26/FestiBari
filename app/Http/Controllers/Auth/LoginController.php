<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Where to redirect users after login
    protected $redirectTo = '/';

    public function __construct()
    {
        // Guests can access login, logout requires auth
        $this->middleware('guest')->except('logout');
    }

    // Show the login form view
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login POST request
    public function login(Request $request)
    {
        // Validate input data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Redirect to intended URL or $redirectTo
            return redirect()->intended($this->redirectTo)->with('success', 'Welcome back!');
        }

        // If authentication failed, return back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    // Logout the user
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate and regenerate session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to homepage or wherever you want
        return redirect('/');
    }
}
