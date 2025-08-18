@extends('admin.layout')

@section('title', 'Festival Management')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-calendar"></i> Festival Management</h2>
    </div>
    <div class="admin-card-body">
        <div class="search-filters">
            <form method="GET" action="{{ route('admin.festivals.index') }}">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search festivals, locations, religions..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="{{ route('admin.festivals.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>

        @if($festivals->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Festival</th>
                        <th>Submitted By</th>
                        <th>Location</th>
                        <th>Religion</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($festivals as $festival)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    @if($festival->image_path)
                                        <img src="{{ asset('storage/' . $festival->image_path) }}" 
                                             alt="{{ $festival->name }}" 
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                                    @endif
                                    <strong>{{ $festival->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $festival->user->name ?? 'Unknown' }}</td>
                            <td>{{ $festival->district === 'other' ? 'Nationwide' : ucfirst($festival->district) }}</td>
                            <td>{{ $festival->religion }}</td>
                            <td>
                                @if($festival->status === 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($festival->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $festival->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.festivals.show', $festival) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($festival->status === 'pending')
                                    <form method="POST" action="{{ route('admin.festivals.updateStatus', $festival) }}" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.festivals.updateStatus', $festival) }}" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-warning btn-sm" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.festivals.destroy', $festival) }}" 
                                      style="display: inline-block;" 
                                      onsubmit="return confirm('Are you sure you want to delete this festival?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $festivals->links() }}
        @else
            <p style="text-align: center; color: #6c757d; padding: 2rem;">
                <i class="fas fa-calendar-times"></i><br>
                No festivals found.
            </p>
        @endif
    </div>
</div>
@endsection
