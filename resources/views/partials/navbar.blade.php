<nav class="navbar">
    <div class="nav-container">

        <a href="{{ route('home') }}" class="logo">
            My<span>Portfolio</span>
        </a>

        <ul class="nav-links">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>

            <li>
                <a href="{{ route('about') }}">About</a>
            </li>

            <li>
                <a href="{{ route('education') }}">Education</a>
            </li>

            <li>
                <a href="{{ route('projects.index') }}">Projects</a>
            </li>
        </ul>
        <div class="nav-auth">
            @guest
                <a href="{{ route('login') }}">Login</a>
            @else
                <span>Halo, {{ Auth::user()->name }}</span>
                <a href="{{ route('profile.saya') }}">Profil</a>
                <a href="{{ route('admin.dashboard') }}">Admin</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-logout" type="submit">Logout</button>
                </form>
            @endguest
        </div>

    </div>
</nav>
