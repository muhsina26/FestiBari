<nav class="navbar">
    <div class="logo">
        <a href="{{ url('/') }}">Festibari</a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/explore') }}">Explore</a></li>
        <li><a href="{{ url('/submit') }}">Submit</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>

       @auth
            <li class="profile-dropdown">
                <a href="#" class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-content">
                    <span class="welcome-msg">Welcome, {{ Auth::user()->name }}</span>
                    <a href="#" class="dropdown-item">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}" class="signup-link">Sign Up</a></li>
        @endauth
    </ul>
</nav>