@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush



@extends('layouts.app')

@section('content')
<section class="auth-hero">
    <div class="overlay">
        <div class="auth-form-container">
            <div class="auth-form">
                <h2><i class="fas fa-ticket-alt"></i> Create Account</h2>
                <form onsubmit="event.preventDefault();">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="firstName">First Name</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="firstName" class="form-input" placeholder="John" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="lastName">Last Name</label>
                                <input type="text" id="lastName" class="form-input" placeholder="Doe" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" class="form-input" placeholder="you@example.com" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" class="form-input" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirmPassword" class="form-input" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <div class="terms">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    
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