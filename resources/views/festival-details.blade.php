@push('styles')
<link rel="stylesheet" href="{{ asset('css/festival-details.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<!-- Hero Section with Festival Image -->
<section class="festival-hero">
    <div class="hero-background" style="background-image: url('{{ $image }}');">
        <div class="hero-overlay">
            <div class="hero-content">
                <nav class="breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <span>/</span>
                    <a href="{{ url('/explore') }}">Explore</a>
                    <span>/</span>
                    <span>{{ $name }}</span>
                </nav>
                <h1 class="hero-title">{{ $name }}</h1>
                @if(false)
                {{-- Intentionally hidden: description moved to explore card back --}}
                <p class="hero-subtitle" style="display:none;">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="festival-content">
    <div class="container">
        <div class="content-grid">
            <!-- Left Column - Main Content -->
            <div class="main-content">
                <!-- Festival Story -->
                @if($description)
                <div class="content-card">
                    <h2><i class="fas fa-book-open"></i> Festival Story</h2>
                    <div class="story-content">
                        <p>{{ $description }}</p>
                    </div>
                </div>
                @endif

                <!-- Program Schedule -->
                @if(isset($events) && count($events) > 0)
                <div class="content-card">
                    <h2><i class="fas fa-clock"></i> Program Schedule</h2>
                    <div class="timeline">
            @foreach($events as $event)
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                <div class="timeline-time">{{ data_get($event, 'time') }}</div>
                <div class="timeline-title">{{ data_get($event, 'title') }}</div>
                <div class="timeline-desc">{{ data_get($event, 'description') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar">
                <!-- Quick Info Card -->
                <div class="sidebar-card">
                    <h3>Festival Info</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-calendar"></i>
                            <div>
                                <span class="info-label">Date</span>
                                <span class="info-value">{{ $date }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <span class="info-label">Duration</span>
                                <span class="info-value">{{ $duration ?? 'Full Day' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <span class="info-label">Location</span>
                                <span class="info-value">{{ $location }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-praying-hands"></i>
                            <div>
                                <span class="info-label">Type</span>
                                <span class="info-value">{{ $category ?? 'Cultural' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="sidebar-card">
                    <div class="action-buttons">
                        <button class="action-btn primary">
                            <i class="fas fa-heart"></i> Save Festival
                        </button>
                        <button class="action-btn secondary">
                            <i class="fas fa-share-alt"></i> Share Festival
                        </button>
                        <a href="https://maps.google.com/?q={{ urlencode($location) }}" target="_blank" class="action-btn outline">
                            <i class="fas fa-directions"></i> Get Directions
                        </a>
                    </div>
                </div>

                <!-- Weather Info (Placeholder) -->
                <div class="sidebar-card">
                    <h3>Weather Forecast</h3>
                    <div class="weather-info">
                        <div class="weather-item">
                            <i class="fas fa-sun"></i>
                            <div>
                                <span class="weather-temp">28°C</span>
                                <span class="weather-desc">Sunny</span>
                            </div>
                        </div>
                        <p class="weather-note">Perfect weather for festival celebrations!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Share functionality
    document.querySelector('.action-btn.secondary').addEventListener('click', function() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $name }}',
                text: 'Check out this amazing festival: {{ $name }}',
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Link copied to clipboard!');
            });
        }
    });

    // Save festival functionality (placeholder)
    document.querySelector('.action-btn.primary').addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-check"></i> Saved!';
        this.style.background = 'rgba(76, 175, 80, 0.8)';
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-heart"></i> Save Festival';
            this.style.background = 'linear-gradient(45deg, #e91e63, #ff4081)';
        }, 2000);
    });
</script>
@endpush