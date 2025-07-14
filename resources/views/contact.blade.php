@push('styles')
<link rel="stylesheet" href="{{ asset('css/submit.css') }}">
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
        <form>
            <div class="form-group">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" id="name" class="form-input" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" id="email" class="form-input" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" class="form-input" placeholder="Feedback / Inquiry / etc." required>
            </div>
            <div class="form-group">
                <label for="message" class="form-label">Your Message</label>
                <textarea id="message" class="form-textarea" placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="form-button">Send Message</button>
        </form>
    </div>
</section>

<!-- Contact Info Section (Optional) -->
<section class="cta" >
    <div class="cta-content">
        <h2>Or reach us directly</h2>
        <p>Email: <a href="mailto:support@festibari.com" style="color: #00bcd4;">support@festibari.com</a></p>
        <p>Phone: <span style="color: #ccc;">+880 1XXX XXX XXX</span></p>
    </div>
</section>

@endsection