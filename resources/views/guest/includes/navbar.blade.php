<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- logo -->
        <a href="/" class="navbar-brand me-lg-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-dark"/>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <!-- menus -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <!-- left menu -->
            <ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item mx-lg-1">
                    <a class="nav-link active" href="">Home</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">About Us</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">Contact Us</a>
                </li>               
            </ul>

            <!-- right menu -->
            @auth
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-0">
                        <a href="{{ route('home') }}" class="nav-link d-lg-none">Dashboard</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info btn-rounded d-none d-lg-inline-flex">
                            <i class="mdi mdi-home me-1"></i> Dashboard
                        </a>
                        <a href="{{ route('login') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                            class="nav-link d-lg-none">Logout</a>
                        <a href="{{ route('login') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                            class="btn btn-sm btn-light btn-rounded d-none d-lg-inline-flex">
                            <i class="mdi mdi-logout-variant me-1"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-0">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="nav-link d-lg-none">Login</a>
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light d-none d-lg-inline-flex">
                                 Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('lodge-information.form') }}" class="nav-link d-lg-none">Volunteer Now</a>
                            <a href="{{ route('lodge-information.form') }}"
                                class="btn btn-sm btn-outline-info d-none d-lg-inline-flex">
                                <i class="mdi mdi-water text-danger me-1"></i>Volunteer Now
                            </a>
                        @endif
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
