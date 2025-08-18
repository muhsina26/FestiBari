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
            
            $request->session()->regenerate();

            
            return redirect()->intended($this->redirectTo)->with('success', 'Welcome back!');
        }

        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        return redirect('/');
    }
}
