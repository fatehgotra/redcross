<nav class="navbar1 navbar-expand-lg1 navbar-dark1 mt-2 ">
    <div class="container">

        <!-- logo -->
        <div class="text-center">
        <a href="{{ url('/') }}" class="navbar-brand me-lg-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-dark" />
        </a>
        </div>

        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button> -->

        <!-- menus -->
        <!-- <div class="collapse navbar-collapse" id="navbarNavDropdown">

           left menu -->
            <!--<ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item mx-lg-1">
                    <a class="nav-link active" href="">Home</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">About Us</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">Contact Us</a>
                </li>
                @auth
                <li class="nav-item mx-lg-1">
                    <a href="{{ route('home') }}" class="nav-link d-lg-none">Dashboard</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a href="{{ route('login') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                    class="nav-link d-lg-none">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @else
                @if (Route::has('login'))
                    <li class="nav-item mx-lg-1">
                        <a href="#sec" class="nav-link d-lg-none">Login</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a href="{{ route('admin.login') }}" class="nav-link d-lg-none">Department Login</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item mx-lg-1">
                        <a href="{{ route('lodge-information.form') }}" class="nav-link d-lg-none">Signup for volunteer</a>
                    </li>
                @endif
                @endauth
            </ul>

           right menu 
            @auth
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-0">
                       
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info btn-rounded d-none d-lg-inline-flex">
                            <i class="mdi mdi-home me-1"></i> Dashboard
                        </a>
                       
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
                            <a href="#sec" class="btn btn-sm btn-outline-light d-none d-lg-inline-flex">
                                Login
                            </a>
                            <a href="{{ route('admin.login') }}"
                                class="btn btn-sm btn-outline-light d-none d-lg-inline-flex">
                                Department Login
                            </a>
                        @endif
                        @if (Route::has('register'))                            
                            <a href="{{ route('lodge-information.form') }}"
                                class="btn btn-sm btn-outline-info d-none d-lg-inline-flex">
                                <i class="mdi mdi-water text-danger me-1"></i>Signup for volunteer
                            </a>
                        @endif
                    </li>
                </ul>
            @endauth

        </div> -->
    </div>
</nav>
