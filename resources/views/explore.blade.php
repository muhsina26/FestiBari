@push('styles')
<link rel="stylesheet" href="{{ asset('css/explore.css') }}">
@endpush


@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="explore-hero">
    <div class="overlay">
        <div class="hero-text">
            <h1>Explore Festivals</h1>
            <p>Search, Filter, and Discover Festivals Across Bangladesh</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="filters">
    <form method="GET" action="{{ route('explore') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name...">
        
        <select name="religion" onchange="this.form.submit()">
            <option value="">Filter by Religion</option>
            @if(isset($religions))
                @foreach($religions as $religion)
                    <option value="{{ $religion }}" {{ request('religion') == $religion ? 'selected' : '' }}>
                        {{ $religion }}
                    </option>
                @endforeach
            @else
                <option value="Islam" {{ request('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Hinduism" {{ request('religion') == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                <option value="Christianity" {{ request('religion') == 'Christianity' ? 'selected' : '' }}>Christianity</option>
                <option value="Buddhism" {{ request('religion') == 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                <option value="Cultural" {{ request('religion') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
            @endif
        </select>
        
        <select name="location" onchange="this.form.submit()">
            <option value="">Filter by Location</option>
            @if(isset($locations))
                @foreach($locations as $location)
                    <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                        {{ $location }}
                    </option>
                @endforeach
            @else
                <option value="Dhaka" {{ request('location') == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                <option value="Chattogram" {{ request('location') == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                <option value="Rajshahi" {{ request('location') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                <option value="Sylhet" {{ request('location') == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
            @endif
        </select>
        
        <select name="time" onchange="this.form.submit()">
            <option value="">Filter by Time</option>
            <option value="Upcoming" {{ request('time') == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="Past" {{ request('time') == 'Past' ? 'selected' : '' }}>Past</option>
        </select>
        
        @if(request()->hasAny(['search', 'religion', 'location', 'time']))
            <a href="{{ route('explore') }}" style="background: #ff4081; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; margin-left: 10px;">Clear Filters</a>
        @endif
    </form>
</section>

<!-- Festival Cards -->
<section class="festival-grid">
    <h2>Featured Festivals</h2>
    <div class="cards-container">
        @php
            use Illuminate\Support\Str;
            $list = isset($festivals) ? $festivals->map(function($f){
                $districtDisplay = $f->district === 'other' ? 'Nationwide' : ucfirst($f->district ?? '');
                return [
                    'id' => $f->id,
                    'name' => $f->name,
                    'image' => $f->image_path ? (Str::startsWith($f->image_path, 'http') ? $f->image_path : asset('storage/'.$f->image_path)) : asset('images/bg.jpg'),
                    'location' => trim(($f->area ? $f->area.', ' : '').$districtDisplay) ?: 'Bangladesh',
                    'date' => optional($f->start_date)->format('Y-m-d'),
                    'religion' => $f->religion,
                    'description' => $f->description,
                ];
            }) : collect([]);
        @endphp
        @forelse ($list as $festival)
        <div class="festival-card">
            <div class="flip-wrapper">
                <div class="flip-inner">
                    <!-- FRONT SIDE -->
                    <div class="flip-front">
                        <img src="{{ is_string($festival['image']) ? $festival['image'] : '/images/'.$festival['image'] }}" alt="{{ $festival['name'] }}">
                        <div class="festival-info">
                            <h3>{{ $festival['name'] }}</h3>
                            <p><i class="fas fa-calendar-alt"></i> {{ $festival['date'] }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> {{ $festival['location'] }}</p>
                            <p><i class="fas fa-praying-hands"></i> {{ $festival['religion'] }}</p>
                            </div>
                    </div>

                    <!-- BACK SIDE -->
                    <div class="flip-back">
                        <div class="festival-info">
                            <h3>History of {{ $festival['name'] }}</h3>
                            <p>{{ Str::limit($festival['description'] ?? 'History info coming soon.', 120) }}</p>
                            <a href="/festival/{{ $festival['id'] }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="no-festivals" style="text-align: center; padding: 40px; color: #666;">
            <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.5;"></i>
            <h3>No festivals found</h3>
            <p>Try adjusting your search or filter criteria.</p>
            @if(request()->hasAny(['search', 'religion', 'location', 'time']))
                <a href="{{ route('explore') }}" style="background: #ff4081; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 10px;">Show All Festivals</a>
            @endif
        </div>
        @endforelse
    </div>
</section>

@push('scripts')
<script>
// Auto-submit search on Enter key
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
        
        // Add search button functionality
        searchInput.addEventListener('input', function() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500); 
        });
    }
});
</script>
@endpush

@endsection