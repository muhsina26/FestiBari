@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<section class="auth-hero">
    <div class="overlay">
        <div class="auth-form-container">
            <div class="auth-form">
                <h2><i class="fas fa-ticket-alt"></i> Create Account</h2>
                @if($errors->any())
    <div class="auth-errors">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                {{-- ✅ Working Laravel form --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    {{-- Full Name (First + Last) --}}
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="firstName">First Name</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="firstName" name="first_name" class="form-input" 
                                           placeholder="John" value="{{ old('first_name') }}" required>
                                </div>
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="lastName">Last Name</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="lastName" name="last_name" class="form-input" 
                                           placeholder="Doe" value="{{ old('last_name') }}" required>
                                </div>
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
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

                    {{-- Password --}}
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

                    {{-- Confirm Password --}}
                    <div class="form-group">
                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirmPassword" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="terms">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn auth-btn">Create Account</button>

                    <div class="auth-divider">or sign up with</div>

                    <div class="social-auth">
                        <button type="button" class="social-btn google">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button type="button" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                    </div>

                    <div class="auth-footer">
                        Already have an account? <a href="{{ route('login') }}">Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
