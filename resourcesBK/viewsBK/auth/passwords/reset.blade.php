<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reset Password| User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Cloudinc" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-1 pb-1 text-center">
                            <a href="{{ route('login') }}">
                                <span><img src="{{ asset('assets/images/logo.png') }}" alt=""
                                        height="150" class="img-fluid"></span>
                            </a>
                        </div>

                        <div class="card-body">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 mb-3 font-weight-bold">Reset Password</h4>
                            </div>

                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="mb-2">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress"
                                        placeholder="Enter your email" value="{{ $email ?? old('email') }}">
                                    @error('email')
                                        <code id="email-error" class="text-danger">{{ $message }}</code>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password">
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
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" placeholder="Confirm your password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-info" type="submit">Reset Password </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> Copyright © Fiji Red Cross Society 2023.
    </footer>

</body>

</html>
