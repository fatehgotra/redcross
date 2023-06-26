<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="50px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid" height="50px">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>


            <li
                class="side-nav-item {{ request()->is('admin/volunteers') || request()->is('admin/volunteers/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.volunteers.index') }}"
                    class="side-nav-link {{ request()->is('admin/volunteers') || request()->is('admin/volunteers/*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" width="22" height="22" aria-hidden="true">
                        <path strokelinecap="round" strokelinejoin="round"
                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                        </path>
                    </svg>

                    @role('admin')
                        <span class="badge bg-dark float-end me-1">{{ \App\Models\User::count() }}</span>
                        <span> Volunteers </span>
                    @else
                        @php
                            $branch = Auth::guard('admin')->user()->branch;
                        @endphp
                        <span
                            class="badge bg-dark float-end me-1">{{ \App\Models\User::with('lodgementInformation')->whereHas('lodgementInformation', function ($q) use ($branch) {
                                    $q->where(function ($q) use ($branch) {
                                        $q->where('registration_location_type', $branch);
                                    });
                                })->count() }}</span>
                        <span> Volunteers </span>
                    @endrole
                </a>
            </li>

            @role('admin')
                <li class="side-nav-item {{ request()->is('admin/learning/courses') || request()->is('admin/learning/courses/*') || request()->is('admin/learning/mcqs') || request()->is('admin/learning/mcqs/*') || request()->is('admin/learning/videos') || request()->is('admin/learning/videos/*') ? 'menuitem-active' : '' }}">
                    <a data-bs-toggle="collapse" href="#learning" aria-expanded="false" aria-controls="learning"
                        class="side-nav-link">
                        <svg class="shrink-0" width="22" height="22" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span> Learning </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="{{ request()->is('admin/learning/courses') || request()->is('admin/learning/courses/*') || request()->is('admin/learning/mcqs') || request()->is('admin/learning/mcqs/*') || request()->is('admin/learning/videos') || request()->is('admin/learning/videos/*') ? 'collapse show' : 'collapse' }}" id="learning">
                        <ul class="side-nav-second-level">
                            <li class="{{ request()->is('admin/learning/courses') || request()->is('admin/learning/courses/*') ? 'menuitem-active' : '' }}">
                                <a href="{{ route('admin.courses.index') }}">Courses</a>
                            </li>
                            <li class="{{ request()->is('admin/learning/mcqs') || request()->is('admin/learning/mcqs/*') ? 'menuitem-active' : '' }}">
                                <a href="{{ route('admin.mcqs.index') }}">MCQs</a>
                            </li>
                            <li class="{{ request()->is('admin/learning/videos') || request()->is('admin/learning/videos/*') ? 'menuitem-active' : '' }}">
                                <a href="{{ route('admin.videos.index') }}">Videos</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="side-nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" width="22" height="22">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>

                        <span> User Management </span>
                    </a>
                </li>
            @endrole

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                    aria-controls="sidebarSettings" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" width="22" height="22" aria-hidden="true">
                        <path strokelinecap="round" strokelinejoin="round"
                            d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z">
                        </path>
                    </svg>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
