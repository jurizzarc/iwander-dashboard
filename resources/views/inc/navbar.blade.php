<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            iWander
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.countries.index') }}">Countries</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.districts.index') }}">Districts</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.cities.index') }}">Cities</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.attractions.index') }}">Attractions</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.businessHours.index') }}">Business Hours</a>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.home') }}">
                            Dashboard
                        </a>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
