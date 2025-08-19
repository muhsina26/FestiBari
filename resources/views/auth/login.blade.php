@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<section class="auth-hero">
    <div class="overlay">
        <div class="auth-form-container">
            <div class="auth-form">
                <h2>Login to Festibari</h2>
                @if($errors->any())
    <div class="auth-errors">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" class="form-input" 
                                   placeholder="you@example.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-options">
                        <label class="remember">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    
                    <button type="submit" class="btn auth-btn">Login</button>

                    <div class="divider">or continue with</div>

                    <div class="social-auth">
                        <button type="button" class="social-btn google">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button type="button" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                    </div>

                    <div class="auth-footer">
                        Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection
