<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    protected $redirectTo = '/';

    public function __construct()
    {
       
        $this->middleware('guest')->except('logout');
    }

  
    public function showLoginForm()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        
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

      
        $request->session()->invalidate();
        $request->session()->regenerateToken();

       
        return redirect('/');
    }
}
