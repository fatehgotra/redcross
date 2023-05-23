<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Registration | User</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Cloudinc" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-1 pb-1 text-center bg-info">
                                <a href="{{ route('register') }}">
                                    <span><img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid" /></span>
                                </a>
                            </div>

                            <div class="card-body">

                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Registration</h4>
                                    <p class="text-muted mb-2">Welcome User !</p>
                                </div>

                                <form action="{{ route('register') }}" method="POST">
                                    @csrf

                                    <div class="mb-2">
                                        <label for="name"
                                            class="col-form-label text-md-end">{{ __('Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" autocomplete="name"
                                            autofocus placeholder="Name">
                                        @error('name')
                                            <code id="name-error"
                                                class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" name="email" id="emailaddress" placeholder="Enter your email" value="{{ old('email') }}">
                                        @error('email')
                                            <code id="email-error" class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Enter your email" value="{{ old('email') }}">
                                        @error('phone')
                                            <code id="phone-error" class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <a href="{{ route('admin.password.request') }}" class="text-muted float-end"><small>Forgot your password?</small></a>
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password')
                                            <code id="password-error" class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="country" class="col-form-label text-md-end">Country <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" data-toggle="select2"
                                            name="country" id="country">
                                            <option value="">Select Country</option>
                                            @foreach (\App\Models\Country::get() as $country)
                                                <option value="{{ $country->iso }}">
                                                    {{ $country->country }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <code id="name-error"
                                                class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>                                    

                                    <div class="mb-0 text-center">
                                        <button class="btn btn-info" type="submit"> Register </button>
                                        <p class="text-muted mt-1">Already have an account? <a href="{{ route('login') }}"
                                            class="text-muted ms-1"><b>Login</b></a></p>
                                    </div>                                    

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © Fiji Red Cross Society
        </footer>

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

    </body>
</html>
