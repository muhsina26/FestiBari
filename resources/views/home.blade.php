@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@extends('layouts.app')

@section('content')



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
    @if($countdownDate && $nextFestival)
        <h2>{{ $nextFestival->name }} Starts In:</h2>
        <div id="timer">
            <span id="days">00</span> Days 
            <span id="hours">00</span> Hours 
            <span id="minutes">00</span> Minutes 
            <span id="seconds">00</span> Seconds
        </div>
    @else
        <h2>No Upcoming Festivals</h2>
        <div id="timer">
            <span>Check back soon for new festivals!</span>
        </div>
    @endif
</section>

<!-- Highlights Section -->
<section class="highlights">
    <h2>Festival Highlights</h2>
    <div class="highlight-cards">
        @forelse($festivals as $festival)
            <div class="card">
                <img src="{{ $festival->image_url }}" alt="{{ $festival->name }}">
                <h3>
                    <a href="{{ route('festival.details', $festival->id) }}" style="color: inherit; text-decoration: none;">
                        {{ $festival->name }}
                    </a>
                </h3>
                <p style="color: #666; font-size: 0.9em; margin-top: 8px;">
                    <i class="fas fa-map-marker-alt"></i> {{ $festival->location }}
                </p>
            </div>
        @empty
            <div class="card">
                <img src="/images/bg.jpg" alt="No festivals">
                <h3>No Festivals Yet</h3>
                <p>Be the first to submit a festival to our platform!</p>
            </div>
        @endforelse
        
        @if($festivals->count() == 1)
            <div class="card">
                <img src="/images/bg.jpg" alt="Submit festival">
                <h3>Submit Your Festival</h3>
                <p>Help us grow our festival collection by adding your event!</p>
            </div>
            <div class="card">
                <img src="/images/bg.jpg" alt="Explore">
                <h3>Explore More</h3>
                <p>Discover amazing festivals happening around Bangladesh!</p>
            </div>
        @elseif($festivals->count() == 2)
            <div class="card">
                <img src="/images/bg.jpg" alt="Submit festival">
                <h3>Submit Your Festival</h3>
                <p>Help us grow our festival collection by adding your event!</p>
            </div>
        @endif
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
    @if($countdownDate)
        const festivalDate = new Date("{{ $countdownDate }}").getTime();

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
    @endif
</script>
@endpush