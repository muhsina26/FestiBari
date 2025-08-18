@extends('admin.layout')

@section('title', 'User Details')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-user"></i> {{ $user->name }}</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" style="float: right;">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>
        <div style="clear: both;"></div>
    </div>
    <div class="admin-card-body">
        <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
            <div>
                <div class="form-group">
                    <label><strong>Full Name:</strong></label>
                    <p>{{ $user->name }}</p>
                </div>

                <div class="form-group">
                    <label><strong>Email Address:</strong></label>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="form-group">
                    <label><strong>Joined:</strong></label>
                    <p>{{ $user->created_at->format('F j, Y \a\t g:i A') }}</p>
                </div>

                <div class="form-group">
                    <label><strong>Total Festivals Submitted:</strong></label>
                    <p>{{ $user->festivals->count() }} festivals</p>
                </div>

                @if($user->festivals->count() > 0)
                    <div class="form-group">
                        <label><strong>Festival Statistics:</strong></label>
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 5px;">
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; text-align: center;">
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #28a745;">
                                        {{ $user->festivals->where('status', 'approved')->count() }}
                                    </div>
                                    <small>Approved</small>
                                </div>
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #ffc107;">
                                        {{ $user->festivals->where('status', 'pending')->count() }}
                                    </div>
                                    <small>Pending</small>
                                </div>
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #dc3545;">
                                        {{ $user->festivals->where('status', 'rejected')->count() }}
                                    </div>
                                    <small>Rejected</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><strong>Submitted Festivals:</strong></label>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Festival Name</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->festivals as $festival)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                @if($festival->image_path)
                                                    <img src="{{ asset('storage/' . $festival->image_path) }}" 
                                                         alt="{{ $festival->name }}" 
                                                         style="width: 30px; height: 30px; object-fit: cover; border-radius: 3px; margin-right: 8px;">
                                                @endif
                                                {{ $festival->name }}
                                            </div>
                                        </td>
                                        <td>{{ $festival->district === 'other' ? 'Nationwide' : ucfirst($festival->district) }}</td>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 5px; text-align: center; color: #6c757d;">
                        <i class="fas fa-calendar-times" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <p>This user hasn't submitted any festivals yet.</p>
                    </div>
                @endif
            </div>

            <div>
                <div class="form-group">
                    <label><strong>User Avatar:</strong></label>
                    <div style="width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: bold; margin: 1rem auto;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="form-group">
                    <label><strong>Account Status:</strong></label>
                    @if($user->email === 'admin@festibari.com')
                        <span class="badge badge-danger" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-crown"></i> Administrator
                        </span>
                    @else
                        <span class="badge badge-success" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-user"></i> Regular User
                        </span>
                    @endif
                </div>

                @if($user->email !== 'admin@festibari.com')
                    <div class="form-group">
                        <label><strong>Actions:</strong></label>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                              onsubmit="return confirm('Are you sure you want to delete this user and all their festivals? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="width: 100%;">
                                <i class="fas fa-trash"></i> Delete User
                            </button>
                        </form>
                        <small style="color: #6c757d; margin-top: 0.5rem; display: block;">
                            This will permanently delete the user and all their submitted festivals.
                        </small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
