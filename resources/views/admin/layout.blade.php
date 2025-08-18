<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - FestiBari Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            line-height: 1.6;
        }

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            font-size: 1.5rem;
            display: inline-block;
        }

        .admin-nav {
            float: right;
            margin-top: 5px;
        }

        .admin-nav a {
            color: white;
            text-decoration: none;
            margin-left: 2rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .admin-nav a:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .admin-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .admin-card-header {
            background: #f8f9fa;
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }

        .admin-card-header h2 {
            color: #495057;
            font-size: 1.25rem;
        }

        .admin-card-body {
            padding: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stat-card.total::before { background: #007bff; }
        .stat-card.approved::before { background: #28a745; }
        .stat-card.pending::before { background: #ffc107; }
        .stat-card.rejected::before { background: #dc3545; }
        .stat-card.users::before { background: #6f42c1; }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-card.total .stat-number { color: #007bff; }
        .stat-card.approved .stat-number { color: #28a745; }
        .stat-card.pending .stat-number { color: #ffc107; }
        .stat-card.rejected .stat-number { color: #dc3545; }
        .stat-card.users .stat-number { color: #6f42c1; }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        .table tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }

        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border: 1px solid #dee2e6;
            color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination .current {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .search-filters {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .search-filters .form-row {
            display: flex;
            gap: 1rem;
            align-items: end;
        }

        .search-filters .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 1rem;
            }
            
            .admin-nav {
                float: none;
                margin-top: 1rem;
            }
            
            .admin-container {
                padding: 0 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .search-filters .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1><i class="fas fa-tachometer-alt"></i> FestiBari Admin</h1>
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('admin.festivals.index') }}"><i class="fas fa-calendar"></i> Festivals</a>
            <a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Users</a>
            <a href="{{ route('home') }}"><i class="fas fa-external-link-alt"></i> View Site</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
        <div style="clear: both;"></div>
    </header>

    <div class="admin-container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
