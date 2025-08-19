@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush


@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="explore-hero">
    <div class="overlay">
        <div class="hero-text">
            <h1>Contact Us</h1>
            <p>Have a question, suggestion, or just want to say hello? Reach out below!</p>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="submit-form-section">
    <div class="form-container">
        <h2 class="form-title">Get In Touch</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" class="form-input" placeholder="Feedback / Inquiry / etc." value="{{ old('subject') }}" required>
            </div>
            <div class="form-group">
                <label for="message" class="form-label">Your Message</label>
                <textarea id="message" name="message" class="form-textarea" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="form-button">Send Message</button>
        </form>
    </div>
</section>

<!-- Contact Info Section -->
<section class="cta">
    <div class="cta-content">
        <h2>Or reach us directly</h2>
        <div class="contact-info">
            <p>
                <i class="fas fa-envelope" style="margin-right: 10px; color: #ff4081;"></i>
                Email: <a href="mailto:support@festibari.com" style="color: #00bcd4;">support@festibari.com</a>
            </p>
            <p>
                <i class="fas fa-phone" style="margin-right: 10px; color: #ff4081;"></i>
                Phone: <span style="color: #ccc;">+880 1781241977</span>
            </p>
        </div>
    </div>
</section>

@endsection
