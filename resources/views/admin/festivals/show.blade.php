@extends('admin.layout')

@section('title', 'Festival Details')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-calendar"></i> {{ $festival->name }}</h2>
        <a href="{{ route('admin.festivals.index') }}" class="btn btn-secondary" style="float: right;">
            <i class="fas fa-arrow-left"></i> Back to Festivals
        </a>
        <div style="clear: both;"></div>
    </div>
    <div class="admin-card-body">
        <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
            <div>
                <div class="form-group">
                    <label><strong>Festival Name:</strong></label>
                    <p>{{ $festival->name }}</p>
                </div>

                <div class="form-group">
                    <label><strong>Description:</strong></label>
                    <p>{{ $festival->description ?: 'No description provided.' }}</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label><strong>Start Date:</strong></label>
                        <p>{{ \Carbon\Carbon::parse($festival->start_date)->format('F j, Y') }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>End Date:</strong></label>
                        <p>{{ $festival->end_date ? \Carbon\Carbon::parse($festival->end_date)->format('F j, Y') : 'Same day' }}</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label><strong>District:</strong></label>
                        <p>{{ $festival->district === 'other' ? 'Nationwide' : ucfirst($festival->district) }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Area:</strong></label>
                        <p>{{ $festival->area ?: 'Not specified' }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label><strong>Full Address:</strong></label>
                    <p>{{ $festival->full_address ?: 'Not provided' }}</p>
                </div>

                <div class="form-group">
                    <label><strong>Religion/Category:</strong></label>
                    <p>{{ $festival->religion }}</p>
                </div>

                @if($festival->latitude && $festival->longitude)
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label><strong>Latitude:</strong></label>
                            <p>{{ $festival->latitude }}</p>
                        </div>
                        <div class="form-group">
                            <label><strong>Longitude:</strong></label>
                            <p>{{ $festival->longitude }}</p>
                        </div>
                    </div>
                @endif

                @if($festival->subevents && count($festival->subevents) > 0)
                    <div class="form-group">
                        <label><strong>Subevents:</strong></label>
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 5px;">
                            @foreach($festival->subevents as $index => $subevent)
                                <div style="border-bottom: 1px solid #dee2e6; padding: 0.5rem 0; {{ $loop->last ? 'border-bottom: none;' : '' }}">
                                    <strong>{{ $subevent['time'] ?? 'No time' }}:</strong> {{ $subevent['title'] ?? 'Untitled' }}
                                    @if(!empty($subevent['description']))
                                        <br><small>{{ $subevent['description'] }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label><strong>Submitted By:</strong></label>
                    <p>{{ $festival->user->name ?? 'Unknown User' }} ({{ $festival->user->email ?? 'No email' }})</p>
                </div>

                <div class="form-group">
                    <label><strong>Submitted On:</strong></label>
                    <p>{{ $festival->created_at->format('F j, Y \a\t g:i A') }}</p>
                </div>
            </div>

            <div>
                @if($festival->image_path)
                    <div class="form-group">
                        <label><strong>Festival Image:</strong></label>
                        <img src="{{ asset('storage/' . $festival->image_path) }}" 
                             alt="{{ $festival->name }}" 
                             style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    </div>
                @endif

                <div class="form-group">
                    <label><strong>Current Status:</strong></label>
                    @if($festival->status === 'approved')
                        <span class="badge badge-success" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-check"></i> Approved
                        </span>
                    @elseif($festival->status === 'pending')
                        <span class="badge badge-warning" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-clock"></i> Pending Review
                        </span>
                    @else
                        <span class="badge badge-danger" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-times"></i> Rejected
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label><strong>Actions:</strong></label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @if($festival->status !== 'approved')
                            <form method="POST" action="{{ route('admin.festivals.updateStatus', $festival) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success" style="width: 100%;">
                                    <i class="fas fa-check"></i> Approve Festival
                                </button>
                            </form>
                        @endif

                        @if($festival->status !== 'rejected')
                            <form method="POST" action="{{ route('admin.festivals.updateStatus', $festival) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-warning" style="width: 100%;">
                                    <i class="fas fa-times"></i> Reject Festival
                                </button>
                            </form>
                        @endif

                        @if($festival->status !== 'pending')
                            <form method="POST" action="{{ route('admin.festivals.updateStatus', $festival) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="pending">
                                <button type="submit" class="btn btn-secondary" style="width: 100%;">
                                    <i class="fas fa-clock"></i> Mark as Pending
                                </button>
                            </form>
                        @endif

                        @if($festival->status === 'approved')
                            <a href="{{ route('festival.details', $festival->id) }}" class="btn btn-primary" style="width: 100%;" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View Live
                            </a>
                        @endif

                        <form method="POST" action="{{ route('admin.festivals.destroy', $festival) }}" 
                              onsubmit="return confirm('Are you sure you want to permanently delete this festival?')" 
                              style="margin-top: 1rem;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="width: 100%;">
                                <i class="fas fa-trash"></i> Delete Festival
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
