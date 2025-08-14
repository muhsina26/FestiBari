@push('styles')
<link rel="stylesheet" href="{{ asset('css/festival-details.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<!-- Hero Section with Festival Image -->
<section class="festival-hero">
        <div class="hero-background" style="background-image: url('/images/{{ $image }}');">
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
                <p class="hero-subtitle">{{ $description }}</p>
</section>

<!-- Main Content Section -->
<section class="festival-content">
    <div class="container">
        <div class="content-grid">
            <!-- Left Column - Main Content -->
            <div class="main-content">
                <!-- Festival Story -->
                <div class="content-card">
                    <h2><i class="fas fa-book-open"></i> Festival Story</h2>
                    <div class="story-content">
                        <p>{{ $description ?? 'Experience the vibrant celebration of ' . $name . ', a magnificent festival that brings together communities in joyous celebration. This festival is deeply rooted in cultural traditions and offers a unique glimpse into the rich heritage of Bangladesh.' }}</p>
                        
                        @if($name == 'Eid ul-Fitr')
                            <p>Eid-ul-Fitr marks the end of Ramadan, the holy month of fasting in Islam. It is celebrated with prayers, charity, and festive meals, bringing families and communities together in a spirit of joy and gratitude.</p>
                        @elseif($name == 'Durga Puja')
                            <p>Durga Puja is a Hindu festival celebrating the goddess Durga's victory over the demon Mahishasura. It symbolizes the victory of good over evil and is celebrated with elaborate decorations, cultural performances, and community gatherings.</p>
                        @elseif($name == 'Pohela Boishakh')
                            <p>Pohela Boishakh is the Bengali New Year, celebrated with traditional food, fairs, and cultural activities. It marks the beginning of the Bengali calendar and is a time for new beginnings and cultural pride.</p>
                        @else
                            <p>This festival holds special significance in the cultural calendar, offering visitors an authentic experience of local traditions, customs, and community spirit.</p>
                        @endif
                    </div>
                </div>

                <!-- Program Schedule -->
                @if(isset($events) && count($events) > 0)
                <div class="content-card">
                    <h2><i class="fas fa-clock"></i> Program Schedule</h2>
                    <div class="timeline">
                        @foreach($events as $event)
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="timeline-time">{{ $event['time'] }}</div>
                                <div class="timeline-title">{{ $event['title'] }}</div>
                                <div class="timeline-desc">{{ $event['description'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Location Section -->
                <div class="content-card">
                    <h2><i class="fas fa-map-marker-alt"></i> Location & Directions</h2>
                    <div class="location-content">
                        <div class="location-map">
                            <div class="map-placeholder">
                                <i class="fas fa-map"></i>
                                <h3>{{ $location }}</h3>
                                <p>Interactive map coming soon</p>
                            </div>
                        </div>
                        <div class="location-info">
                            <div class="address-card">
                                <h4>📍 Address</h4>
                                <p>{{ $location }}, Bangladesh</p>
                                <a href="https://maps.google.com/?q={{ urlencode($location) }}" target="_blank" class="directions-btn">
                                    <i class="fas fa-directions"></i> Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="sidebar">
                
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

                
                <div class="sidebar-card">
                    <h3>Entry Information</h3>
                    <div class="ticket-status">
                        <div class="free-entry">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Free Entry</span>
                        </div>
                        <p class="entry-note">No tickets required. Open to all visitors.</p>
                    </div>
                </div>

                
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
    
    document.querySelector('.action-btn.secondary').addEventListener('click', function() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $name }}',
                text: 'Check out this amazing festival: {{ $name }}',
                url: window.location.href
            });
        } else {// Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Link copied to clipboard!');
            });
        }
    });

    
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