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
        @php
            use Illuminate\Support\Str;
            $demo = [
                ['id'=>1,'name' => 'Eid-ul-Fitr', 'image' => 'eidd.jpg', 'location' => 'Nationwide', 'date' => '2025-04-22', 'religion' => 'Islam'],
                ['id'=>2,'name' => 'Eid-ul-Adha', 'image' => 'Quarbani.jpg', 'location' => 'Nationwide', 'date' => '2025-04-22', 'religion' => 'Islam'],
                ['id'=>3,'name' => 'Durga Puja', 'image' => 'DurgaPuja.jpg', 'location' => 'Dhaka, Barisal', 'date' => '2025-10-20', 'religion' => 'Hinduism'],
                ['id'=>4,'name' => '21st February', 'image' => '21feb.jpg', 'location' => 'Jessore', 'date' => '2025-11-15', 'religion' => 'Cultural'],
            ];
            $list = (isset($festivals) && count($festivals)) ? $festivals->map(function($f){
                return [
                    'id' => $f->id,
                    'name' => $f->name,
                    'image' => $f->image_path ? (Str::startsWith($f->image_path, 'http') ? $f->image_path : asset('storage/'.$f->image_path)) : asset('images/bg.jpg'),
                    'location' => trim(($f->area ? $f->area.', ' : '').($f->district ?? '')) ?: 'Bangladesh',
                    'date' => optional($f->start_date)->format('Y-m-d'),
                    'religion' => $f->religion,
                ];
            }) : collect($demo);
        @endphp
        @foreach ($list as $festival)
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
                            <p>History info coming soon.</p>
                           <a href="/festival/{{ $festival['id'] }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection