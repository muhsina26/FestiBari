@extends('admin.layout')

@section('title', 'User Management')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-users"></i> User Management</h2>
    </div>
    <div class="admin-card-body">
        <div class="search-filters">
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search users by name or email..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>

        @if($users->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Festivals</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->email === 'admin@festibari.com')
                                            <span class="badge badge-danger" style="margin-left: 5px;">Admin</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-success">{{ $user->festivals_count }}</span>
                                festival{{ $user->festivals_count !== 1 ? 's' : '' }}
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($user->email !== 'admin@festibari.com')
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                          style="display: inline-block;" 
                                          onsubmit="return confirm('Are you sure you want to delete this user and all their festivals?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        @else
            <p style="text-align: center; color: #6c757d; padding: 2rem;">
                <i class="fas fa-user-times"></i><br>
                No users found.
            </p>
        @endif
    </div>
</div>
@endsection
