
<nav class="navbar">

    <a href="{{ url('/') }}" class="brand">
        Training Institute
    </a>

    <div>

        @auth

            <a href="{{ route('students.index') }}"
               class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                Students
            </a>

            <a href="{{ route('courses.index') }}"
               class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
                Courses
            </a>

            <form action="{{ route('logout') }}"
                  method="POST"
                  style="display: inline;">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>

        @endauth

        @guest

            <a href="{{ route('register') }}"
               class="{{ request()->routeIs('register') ? 'active' : '' }}">
                Register
            </a>

            <a href="{{ route('login') }}"
               class="{{ request()->routeIs('login') ? 'active' : '' }}">
                Login
            </a>

        @endguest

    </div>

</nav>
