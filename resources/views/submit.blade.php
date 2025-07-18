
@push('styles')
<link rel="stylesheet" href="{{ asset('css/submit.css') }}">
@endpush

@extends('layouts.app')

@section('content')

<!-- Hero Banner -->
<section class="explore-hero">
    <div class="overlay">
        <div class="hero-text">
            <h1>Submit a Festival</h1>
            <p>Help us grow the collection by adding a festival</p>
        </div>
    </div>
</section>

<!-- Submit Form Section -->
<section class="submit-form-section">
    <div class="form-container">
        <h2 class="form-title">Festival Submission</h2>
        <form>
            <div class="form-group">
                <label for="name" class="form-label">Festival Name</label>
                <input type="text" id="name" class="form-input" placeholder="E.g., Pohela Boishakh" required>
            </div>

            <div class="form-group">
                <label for="date" class="form-label">Festival Date</label>
                <input type="date" id="date" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="location" class="form-label">Location</label>
                <input type="text" id="location" class="form-input" placeholder="E.g., Dhaka, Jessore" required>
            </div>

            <div class="form-group">
                <label for="religion" class="form-label">Religion</label>
                <select id="religion" class="form-select" required>
                    <option disabled selected>Select Religion</option>
                    <option>Islam</option>
                    <option>Hinduism</option>
                    <option>Christianity</option>
                    <option>Buddhism</option>
                    <option>Cultural</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Festival Image (URL)</label>
                <input type="text" id="image" class="form-input" placeholder="e.g., /images/pohela.jpg">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Festival Description</label>
                <textarea id="description" class="form-textarea" placeholder="Briefly describe the festival..." required></textarea>
            </div>

             <div class="subevents-section">
                <h3 class="form-title">Subevents (Optional)</h3>
                <div class="subevent">
                    <div class="form-group">
                        <label for="subevent-time-1" class="form-label">Time</label>
                        <input type="text" id="subevent-time-1" class="form-input" placeholder="e.g., 9:00 AM - 10:00 AM">
                    </div>
                    <div class="form-group">
                        <label for="subevent-title-1" class="form-label">Title</label>
                        <input type="text" id="subevent-title-1" class="form-input" placeholder="e.g., Cultural Program">
                    </div>
                    <div class="form-group">
                        <label for="subevent-desc-1" class="form-label">Description</label>
                        <textarea id="subevent-desc-1" class="form-textarea" placeholder="Description of the subevent..."></textarea>
                    </div>
                </div>
                <button type="button" class="secondary-btn" id="add-subevent">Add Another Subevent</button>
            </div>

            <button class="form-button" type="submit">Submit Festival</button>

           
        </form>
    </div>
</section>
@push('scripts')
<script>
    document.getElementById('add-subevent').addEventListener('click', function() {
        const container = document.querySelector('.subevents-section');
        const subeventCount = document.querySelectorAll('.subevent').length + 1;
        
        const newSubevent = document.createElement('div');
        newSubevent.className = 'subevent';
        newSubevent.innerHTML = `
            <div class="form-group">
                <label for="subevent-time-${subeventCount}" class="form-label">Time</label>
                <input type="text" id="subevent-time-${subeventCount}" class="form-input" placeholder="e.g., 9:00 AM - 10:00 AM">
            </div>
            <div class="form-group">
                <label for="subevent-title-${subeventCount}" class="form-label">Title</label>
                <input type="text" id="subevent-title-${subeventCount}" class="form-input" placeholder="e.g., Cultural Program">
            </div>
            <div class="form-group">
                <label for="subevent-desc-${subeventCount}" class="form-label">Description</label>
                <textarea id="subevent-desc-${subeventCount}" class="form-textarea" placeholder="Description of the subevent..."></textarea>
            </div>
        `;
        
        container.insertBefore(newSubevent, this);
    });
</script>
@endpush

@endsection
