<nav class="navbar">
    <div class="logo">
        <a href="{{ url('/') }}">Festibari</a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/explore') }}">Explore</a></li>
        <li><a href="{{ url('/submit') }}">Submit</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>

        @guest
            <li id="login-item"><a href="{{ route('login') }}" class="auth-link">Login</a></li>
            <li id="signup-item"><a href="{{ route('register') }}" class="auth-link signup-link">Sign Up</a></li>
        @else
            <li class="profile-dropdown" id="profile-item">
                <a href="#" class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-content">
                    <span class="welcome-msg">Welcome, {{ Auth::user()->name }}</span>
                    <a href="#" class="dropdown-item">Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" id="logout-button" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>