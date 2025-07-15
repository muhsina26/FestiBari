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
    <form>
        <input type="text" placeholder="Search by name...">
        <select>
            <option disabled selected>Filter by Religion</option>
            <option>Islam</option>
            <option>Hinduism</option>
            <option>Christianity</option>
            <option>Buddhism</option>
        </select>
        <select>
            <option disabled selected>Filter by Location</option>
            <option>Dhaka</option>
            <option>Chattogram</option>
            <option>Rajshahi</option>
            <option>Sylhet</option>
        </select>
        <select>
            <option disabled selected>Filter by Time</option>
            <option>Upcoming</option>
            <option>Past</option>
        </select>
    </form>
</section>

<!-- Festival Cards -->
<section class="festival-grid">
    <h2>Featured Festivals</h2>
    <div class="cards-container">
        @foreach ([
             ['name' => 'Eid-ul-Fitr', 'image' => 'eidd.jpg', 'location' => 'Nationwide', 'date' => '2025-04-22', 'religion' => 'Islam'],
            ['name' => 'Eid-ul-Adha', 'image' => 'Quarbani.jpg', 'location' => 'Nationwide', 'date' => '2025-04-22', 'religion' => 'Islam'],
            ['name' => 'Durga Puja', 'image' => 'DurgaPuja.jpg', 'location' => 'Dhaka, Barisal', 'date' => '2025-10-20', 'religion' => 'Hinduism'],
            ['name' => '21st February', 'image' => '21feb.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Nabanna Utsab', 'image' => 'Nabannautsab.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'BookFair', 'image' => 'boimela.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Pohela Boishakh', 'image' => 'PohelaBoishakh.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Boishakhi Mela', 'image' => 'Boishakhimela.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Buddha Purnima', 'image' => 'Budda.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Christmas', 'image' => 'Christmas.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Shadinota Dibos', 'image' => 'Independenceday.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Kite Festival', 'image' => 'Kite.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Lalon Mela', 'image' => 'lalonMela.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Pitha Utsab', 'image' => 'pithaUtsab.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Poush Mela', 'image' => 'PoushMela.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Banijjo Mela', 'image' => 'tradeFair.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ['name' => 'Bijoy Dibos', 'image' => 'victory day.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
        ] as $festival)
        <div class="festival-card">
            <div class="flip-wrapper">
                <div class="flip-inner">
                    <!-- FRONT SIDE -->
                    <div class="flip-front">
                        <img src="/images/{{ $festival['image'] }}" alt="{{ $festival['name'] }}">
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
                            @if($festival['name'] == 'Eid-ul-Fitr')
                                <p>
                                    Eid-ul-Fitr marks the end of Ramadan, the holy month of fasting in Islam.
                                    It is celebrated with prayers, charity, and festive meals.
                                </p>
                            @elseif($festival['name'] == 'Durga Puja')
                                <p>
                                    Durga Puja is a Hindu festival celebrating the goddess Durga's victory over the demon Mahishasura.
                                    It symbolizes the victory of good over evil.
                                </p>
                            @elseif($festival['name'] == 'Pohela Boishakh')
                                <p>
                                    Pohela Boishakh is the Bengali New Year, celebrated with traditional food, fairs, and cultural activities.
                                </p>
                            @else
                                <p>History info coming soon.</p>
                            @endif
                            <a href="{{ url('/festivals/' . Str::slug($festival['name'])) }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Story Mode Section
<section class="festival-stories">
    <h2>Festival Stories</h2>
    <div class="story-container">
        <div class="story">
            <h3>A Day in Pahela Baishakh</h3>
            <p>Explore the joy, colors, and emotions of Bengali New Year through an immersive storytelling experience.</p>
        </div>
        More stories can be added -->
    <!-- </div>
</section> -->

@endsection