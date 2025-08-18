<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    
    protected $redirectTo = '/';

    public function __construct()
    {
        
        $this->middleware('guest');
    }

    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        
        $validator = $this->validator($request->all());
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        
        $user = $this->create($request->all());

        
        Auth::login($user);

        
        return redirect($this->redirectTo)->with('success', 'Registration successful! Welcome to Festibari.');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    
    protected function create(array $data)
    {
        return User::create([
            'name'     => trim($data['first_name'] . ' ' . $data['last_name']),
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
