@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card total">
        <div class="stat-number">{{ $stats['total_festivals'] }}</div>
        <div class="stat-label">Total Festivals</div>
    </div>
    <div class="stat-card approved">
        <div class="stat-number">{{ $stats['approved_festivals'] }}</div>
        <div class="stat-label">Approved</div>
    </div>
    <div class="stat-card pending">
        <div class="stat-number">{{ $stats['pending_festivals'] }}</div>
        <div class="stat-label">Pending</div>
    </div>
    <div class="stat-card rejected">
        <div class="stat-number">{{ $stats['rejected_festivals'] }}</div>
        <div class="stat-label">Rejected</div>
    </div>
    <div class="stat-card users">
        <div class="stat-number">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Total Users</div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-calendar"></i> Recent Festivals</h2>
    </div>
    <div class="admin-card-body">
        @if($recent_festivals->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Festival Name</th>
                        <th>Submitted By</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_festivals as $festival)
                        <tr>
                            <td>{{ $festival->name }}</td>
                            <td>{{ $festival->user->name ?? 'Unknown' }}</td>
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
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center; margin-top: 1rem;">
                <a href="{{ route('admin.festivals.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> View All Festivals
                </a>
            </div>
        @else
            <p style="text-align: center; color: #6c757d; padding: 2rem;">
                <i class="fas fa-calendar-times"></i><br>
                No festivals submitted yet.
            </p>
        @endif
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-users"></i> Recent Users</h2>
    </div>
    <div class="admin-card-body">
        @if($recent_users->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center; margin-top: 1rem;">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> View All Users
                </a>
            </div>
        @else
            <p style="text-align: center; color: #6c757d; padding: 2rem;">
                <i class="fas fa-user-times"></i><br>
                No users registered yet.
            </p>
        @endif
    </div>
</div>
@endsection
