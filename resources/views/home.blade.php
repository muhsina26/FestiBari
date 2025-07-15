@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush


@extends('layouts.app')

@section('content')
<!-- Navbar -->
 <!-- @include('partials.nav') -->
<!-- <nav class="navbar">
    <div class="logo">
        <a href="{{ url('/') }}">Festibari</a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/explore') }}">Explore</a></li>
        <li><a href="{{ url('/submit') }}">Submit</a></li>
    </ul>
</nav> -->

<!-- Hero Section -->
<section class="hero">
    <div class="overlay">
        <div class="hero-text">
            <h1>Festibari</h1>
            <p>Discover and celebrate the festivals of Bangladesh</p>
            <a href="{{ url('/explore') }}" class="btn">Explore Now</a>
        </div>
    </div>
</section>

<!-- Countdown Section -->
<section class="countdown">
    <h2>Next Big Festival Starts In:</h2>
    <div id="timer">
        <span id="days">00</span> Days 
        <span id="hours">00</span> Hours 
        <span id="minutes">00</span> Minutes 
        <span id="seconds">00</span> Seconds
    </div>
</section>

<!-- Highlights Section -->
<section class="highlights">
    <h2>Festival Highlights</h2>
    <div class="highlight-cards">
        <div class="card">
            <img src="/images/eid.jpg" alt="Eid Festival">
            <h3>Eid</h3>
            <p>A vibrant celebration marking the end of Ramadan and Qurbani.</p>
        </div>
        <div class="card">
            <img src="/images/boishakh.jpg" alt="Pahela Baishakh">
            <h3>Pahela Baishakh</h3>
            <p>Celebrate the Bengali New Year with colors, parades, and fairs.</p>
        </div>
        <div class="card">
            <img src="/images/puja.jpg" alt="Durga Puja">
            <h3>Durga Puja</h3>
            <p>The grand Hindu festival honoring Goddess Durga’s victory.</p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="cta-content">
        <h2>Are you an organizer?</h2>
        <p>Submit your festival and reach thousands of festival lovers!</p>
        <a href="{{ url('/submit') }}" class="btn">Submit Festival</a>
    </div>
</section>

@endsection



@push('scripts')
<script>
    const festivalDate = new Date("2025-06-15T00:00:00").getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = festivalDate - now;

        if (distance < 0) {
            document.getElementById("timer").innerHTML = "Festival Started!";
            clearInterval(interval);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = days.toString().padStart(2, '0');
        document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
        document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
        document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    const interval = setInterval(updateCountdown, 1000);
</script>
@endpush