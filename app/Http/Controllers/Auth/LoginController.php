<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //login success hole home page a niye jabe
    protected $redirectTo = '/';

    public function __construct()
    {
        //lohin sara o sob use korte parbe except logout
        $this->middleware('guest')->except('logout');
    }

    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //input validate kortese
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //eita hosse search kortese database a email pass milanor jonno
        if (Auth::attempt($credentials, $request->filled('remember'))) {
          //login success hole new session banabe  
            $request->session()->regenerate();

            //login success hole home page a niye jabe
            return redirect()->intended($this->redirectTo)->with('success', 'Welcome back!');
        }

        //Jodi bhul hoi tahole error soho ferot jabe ager jaigai
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        //logout er por old session invalidate hobe
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        return redirect('/');
    }
}
