<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('home') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                height="50px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                class="img-fluid" height="50px">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('home') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            {{-- <img src="assets/images/logo-dark.png" alt="" height="16"> --}}
            <h2 class="text-primary">{{ config('app.name', 'Laravel') }}</h2>
        </span>
        <span class="logo-sm">
            {{-- <img src="assets/images/logo_sm_dark.png" alt="" height="16"> --}}
            <h2 class="text-primary">RC</h2>
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('home') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('my-profile/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('my-profile.lodge-information.form') }}" class="side-nav-link {{ request()->is('my-profile/*') ? 'active' : '' }}">
                    <i class="uil-user-check"></i>
                    <span> My Profile </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('learning/courses') || request()->is('learning/courses/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('learning.courses') }}" class="side-nav-link">
                    <svg class="shrink-0" width="22" height="22" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="ms-2"> Learning </span>
                </a>
            </li>
           

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                    aria-controls="sidebarSettings" class="side-nav-link">
                    <i class="mdi mdi-tools"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('my-account.edit', Auth::user()->id) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
