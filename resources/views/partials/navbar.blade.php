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
                <a href="{{ route('projects') }}">Projects</a>
            </li>
        </ul>

    </div>
</nav>