<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('division-manager.dashboard') }}" class="logo text-center logo-light">
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
    <a href="{{ route('division-manager.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('division-manager.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>


            <li
                class="side-nav-item {{ request()->is('division-manager/volunteers') || request()->is('division-manager/volunteers/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('division-manager.volunteers.index') }}"
                    class="side-nav-link {{ request()->is('division-manager/volunteers') || request()->is('division-manager/volunteers/*') ? 'active' : '' }}">
                    <i class="mdi mdi-account-group-outline"></i>                  
                    <span
                        class="badge bg-warning float-end me-1">{{ \App\Models\User::where('status', 'approve')->whereIn('approved_by', ['Administrator', 'Division Manager','Branch Level', 'HQ'])->count() }}</span>
                    <span> Volunteers </span>
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
                            <a href="{{ route('division-manager.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('division-manager.my-account.edit', Auth::guard('division-manager')->id()) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
