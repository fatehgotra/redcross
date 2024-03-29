<div class="end-bar">

    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Settings</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>

        <div class="p-3">

            <!-- Settings -->
            <h5 class="mt-3">Theme</h5>
            <hr class="mt-1" />

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light"
                    id="light-mode-check" checked>
                <label class="form-check-label" for="light-mode-check">Light Theme</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark"
                    id="dark-mode-check">
                <label class="form-check-label" for="dark-mode-check">Dark Theme</label>
            </div>

        </div> <!-- end padding-->

        <div class="p-3">

            <!-- Settings -->
            <h5 class="mt-3">Roles</h5>
            <hr class="mt-1" />
            @foreach (Auth::guard('admin')->user()->roles as $role)
            <i class="dripicons-jewel text-primary"></i> {{ ucfirst(str_replace('-', ' ', $role->name)) }}<br>
            @endforeach

    </div>

    <div class="p-3">

        <!-- Settings -->
        <h5 class="mt-3">Branch</h5>
        <hr class="mt-1" />
        @empty(Auth::guard('admin')->user()->branch)

        @else
        @foreach (Auth::guard('admin')->user()->branch as $branch)
        <i class="dripicons-jewel text-primary"></i> {{ ucfirst($branch) }}<br>
        @endforeach
        @endempty

</div>
</div>

<div class="rightbar-overlay"></div>
