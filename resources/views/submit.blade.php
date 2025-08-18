
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
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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

        <form method="POST" action="{{ route('festival.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Festival Name</label>
                <input type="text" id="name" name="festival_name" class="form-input" placeholder="E.g., Pohela Boishakh" required>
            </div>

            <div class="form-group">
                <label for="date" class="form-label">Festival Date</label>
                <input type="date" id="date" name="start_date" class="form-input" required>
            </div>

            <!-- Enhanced Location Section -->
            <div class="location-section">
                <h3 class="section-title">
                    <i class="fas fa-map-marker-alt"></i>
                    Location Information
                </h3>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="district" class="form-label">District/City</label>
                            <select id="district" name="district" class="form-select" required>
                                <option disabled selected>Select District</option>
                                <option value="dhaka">Dhaka</option>
                                <option value="chittagong">Chattogram</option>
                                <option value="rajshahi">Rajshahi</option>
                                <option value="sylhet">Sylhet</option>
                                <option value="khulna">Khulna</option>
                                <option value="barisal">Barisal</option>
                                <option value="rangpur">Rangpur</option>
                                <option value="mymensingh">Mymensingh</option>
                                <option value="jessore">Jessore</option>
                                <option value="cumilla">Cumilla</option>
                                <option value="bogura">Bogura</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="area" class="form-label">Area/Upazila</label>
                            <input type="text" id="area" name="area" class="form-input" 
                                   placeholder="e.g., Dhanmondi, Gulshan">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fullAddress" class="form-label">Full Address</label>
                    <textarea id="fullAddress" name="full_address" class="form-textarea" 
                              placeholder="House/Building number, Road, detailed address..."></textarea>
                </div>

                <div class="form-group">
                    <label for="landmark" class="form-label">Landmark Reference (Optional)</label>
                    <input type="text" id="landmark" name="landmark" class="form-input" 
                           placeholder="e.g., Near Dhaka University, Opposite City Mall">
                </div>

                <!-- Map Section -->
                <div class="map-container">
                    <label class="form-label">
                        <i class="fas fa-map"></i>
                        Pin Location on Map
                    </label>
                    <div class="map-wrapper">
                        <div id="location-map" class="location-map">
                            <div class="map-placeholder">
                                <i class="fas fa-map-marked-alt"></i>
                                <h4>Interactive Map</h4>
                                <p>Click on the map or drag the pin to set exact location</p>
                                <div class="map-buttons">
                                    <button type="button" id="useMyLocation" class="map-btn">
                                        <i class="fas fa-crosshairs"></i> Use My Location
                                    </button>
                                    <button type="button" id="searchAddress" class="map-btn">
                                        <i class="fas fa-search"></i> Search Address
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="coordinates-display">
                            <div class="coord-item">
                                <label>Latitude:</label>
                                <input type="text" id="latitude" name="latitude" readonly class="coord-input">
                            </div>
                            <div class="coord-item">
                                <label>Longitude:</label>
                                <input type="text" id="longitude" name="longitude" readonly class="coord-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="religion" class="form-label">Religion</label>
                <select id="religion" name="religion" class="form-select" required>
                    <option disabled selected>Select Religion</option>
                    <option>Islam</option>
                    <option>Hinduism</option>
                    <option>Christianity</option>
                    <option>Buddhism</option>
                    <option>Cultural</option>
                    <option>National</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Festival Image</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="image" name="image" class="form-file-input" accept="image/*" required>
                    <label for="image" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span class="file-text">Choose an image or drag & drop</span>
                    </label>
                    <div class="file-info" style="display: none;">
                        <span class="file-name"></span>
                        <button type="button" class="remove-file">&times;</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Festival Description</label>
                <textarea id="description" name="description" class="form-textarea" placeholder="Briefly describe the festival..." required></textarea>
            </div>

             <div class="subevents-section">
                <h3 class="form-title">Subevents (Optional)</h3>
                <div class="subevent">
                    <div class="form-group">
                        <label for="subevent-time-1" class="form-label">Time</label>
                        <input type="text" id="subevent-time-1" name="subevent_time[]" class="form-input" placeholder="e.g., 9:00 AM - 10:00 AM">
                    </div>
                    <div class="form-group">
                        <label for="subevent-title-1" class="form-label">Title</label>
                        <input type="text" id="subevent-title-1" name="subevent_title[]" class="form-input" placeholder="e.g., Cultural Program">
                    </div>
                    <div class="form-group">
                        <label for="subevent-desc-1" class="form-label">Description</label>
                        <textarea id="subevent-desc-1" name="subevent_description[]" class="form-textarea" placeholder="Description of the subevent..."></textarea>
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
    
    let currentLatitude = null;
    let currentLongitude = null;

    
    document.getElementById('useMyLocation').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Getting Location...';
        btn.disabled = true;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                currentLatitude = position.coords.latitude;
                currentLongitude = position.coords.longitude;
                
                document.getElementById('latitude').value = currentLatitude.toFixed(6);
                document.getElementById('longitude').value = currentLongitude.toFixed(6);
                
                
                updateMapPlaceholder(currentLatitude, currentLongitude);
                
                btn.innerHTML = '<i class="fas fa-check"></i> Location Set!';
                btn.style.background = 'rgba(76, 175, 80, 0.3)';
                btn.style.color = '#4caf50';
                btn.style.borderColor = 'rgba(76, 175, 80, 0.4)';
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = 'rgba(255, 64, 129, 0.2)';
                    btn.style.color = '#ff4081';
                    btn.style.borderColor = 'rgba(255, 64, 129, 0.4)';
                    btn.disabled = false;
                }, 3000);
            }, function(error) {
                btn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Error';
                btn.style.background = 'rgba(244, 67, 54, 0.2)';
                btn.style.color = '#f44336';
                alert('Unable to get your location. Please set manually.');
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = 'rgba(255, 64, 129, 0.2)';
                    btn.style.color = '#ff4081';
                    btn.disabled = false;
                }, 3000);
            });
        } else {
            alert('Geolocation is not supported by this browser.');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

    
    document.getElementById('searchAddress').addEventListener('click', function() {
        const district = document.getElementById('district').value;
        const area = document.getElementById('area').value;
        const fullAddress = document.getElementById('fullAddress').value;
        
        if (!district || !area) {
            alert('Please fill in District and Area fields first.');
            return;
        }
        
        //simulate korsi karon API nai
        const searchQuery = `${area}, ${district}, Bangladesh`;
        
        // Dummy add korsi time pele implement krbo
        const cityCoordinates = {
            'Dhaka': { lat: 23.8103, lng: 90.4125 },
            'Chattogram': { lat: 22.3569, lng: 91.7832 },
            'Rajshahi': { lat: 24.3745, lng: 88.6042 },
            'Sylhet': { lat: 24.8949, lng: 91.8687 },
            'Khulna': { lat: 22.8456, lng: 89.5403 },
            'Barisal': { lat: 22.7010, lng: 90.3535 },
            'Rangpur': { lat: 25.7439, lng: 89.2752 },
            'Mymensingh': { lat: 24.7471, lng: 90.4203 },
            'Jessore': { lat: 23.1697, lng: 89.2134 }
        };
        
        const coords = cityCoordinates[district];
        if (coords) {
            
            currentLatitude = coords.lat + (Math.random() - 0.5) * 0.1;
            currentLongitude = coords.lng + (Math.random() - 0.5) * 0.1;
            
            document.getElementById('latitude').value = currentLatitude.toFixed(6);
            document.getElementById('longitude').value = currentLongitude.toFixed(6);
            
            updateMapPlaceholder(currentLatitude, currentLongitude);
            
            this.innerHTML = '<i class="fas fa-check"></i> Location Found!';
            this.style.background = 'rgba(76, 175, 80, 0.3)';
            this.style.color = '#4caf50';
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-search"></i> Search Address';
                this.style.background = 'rgba(255, 64, 129, 0.2)';
                this.style.color = '#ff4081';
            }, 3000);
        } else {
            alert('Location not found. Please use "Use My Location" or set coordinates manually.');
        }
    });

    
    function updateMapPlaceholder(lat, lng) {
        const mapPlaceholder = document.querySelector('.map-placeholder');
        mapPlaceholder.innerHTML = `
            <i class="fas fa-map-pin" style="color: #4caf50; font-size: 3rem;"></i>
            <h4 style="color: #4caf50;">Location Set!</h4>
            <p>Latitude: ${lat.toFixed(6)}</p>
            <p>Longitude: ${lng.toFixed(6)}</p>
            <div class="map-buttons">
                <button type="button" id="useMyLocation" class="map-btn">
                    <i class="fas fa-crosshairs"></i> Use My Location
                </button>
                <button type="button" id="searchAddress" class="map-btn">
                    <i class="fas fa-search"></i> Search Address
                </button>
            </div>
        `;
        
        
        document.getElementById('useMyLocation').addEventListener('click', arguments.callee.caller);
        document.getElementById('searchAddress').addEventListener('click', arguments.callee.caller);
    }

    
    document.getElementById('district').addEventListener('change', function() {
        
        document.getElementById('latitude').value = '';
        document.getElementById('longitude').value = '';
        currentLatitude = null;
        currentLongitude = null;
    });

    document.getElementById('area').addEventListener('input', function() {
       
        document.getElementById('latitude').value = '';
        document.getElementById('longitude').value = '';
        currentLatitude = null;
        currentLongitude = null;
    });

   
    const fileInput = document.getElementById('image');
    const fileLabel = document.querySelector('.file-upload-label');
    const fileInfo = document.querySelector('.file-info');
    const fileName = document.querySelector('.file-name');
    const removeBtn = document.querySelector('.remove-file');
    const fileText = document.querySelector('.file-text');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            fileLabel.style.display = 'none';
            fileInfo.style.display = 'flex';
        }
    });

    removeBtn.addEventListener('click', function() {
        fileInput.value = '';
        fileLabel.style.display = 'flex';
        fileInfo.style.display = 'none';
    });

   
    let dragCounter = 0;

    fileLabel.addEventListener('dragenter', function(e) {
        e.preventDefault();
        dragCounter++;
        this.style.borderColor = '#ff4081';
        this.style.background = 'rgba(255, 64, 129, 0.1)';
        this.style.color = '#ff4081';
    });

    fileLabel.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dragCounter--;
        if (dragCounter === 0) {
            this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
            this.style.background = 'rgba(255, 255, 255, 0.08)';
            this.style.color = '#f5f5f5';
        }
    });

    fileLabel.addEventListener('dragover', function(e) {
        e.preventDefault();
    });

    fileLabel.addEventListener('drop', function(e) {
        e.preventDefault();
        dragCounter = 0;
        this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
        this.style.background = 'rgba(255, 255, 255, 0.08)';
        this.style.color = '#f5f5f5';
        
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            fileInput.files = files;
            fileName.textContent = files[0].name;
            fileLabel.style.display = 'none';
            fileInfo.style.display = 'flex';
        }
    });

    // subevent functionality
    document.getElementById('add-subevent').addEventListener('click', function() {
        const container = document.querySelector('.subevents-section');
        const subeventCount = document.querySelectorAll('.subevent').length + 1;
        
        const newSubevent = document.createElement('div');
        newSubevent.className = 'subevent';
    newSubevent.innerHTML = `
            <div class="form-group">
                <label for="subevent-time-${subeventCount}" class="form-label">Time</label>
        <input type="text" id="subevent-time-${subeventCount}" name="subevent_time[]" class="form-input" placeholder="e.g., 9:00 AM - 10:00 AM">
            </div>
            <div class="form-group">
                <label for="subevent-title-${subeventCount}" class="form-label">Title</label>
        <input type="text" id="subevent-title-${subeventCount}" name="subevent_title[]" class="form-input" placeholder="e.g., Cultural Program">
            </div>
            <div class="form-group">
                <label for="subevent-desc-${subeventCount}" class="form-label">Description</label>
        <textarea id="subevent-desc-${subeventCount}" name="subevent_description[]" class="form-textarea" placeholder="Description of the subevent..."></textarea>
            </div>
        `;
        
        container.insertBefore(newSubevent, this);
    });
</script>
@endpush

@endsection
