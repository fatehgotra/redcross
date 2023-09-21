@extends('layouts.app')
@section('title', 'Home | Fiji Red Cross Society')
@section('content')
@include('admin.includes.flash-message')
<section>
    <div class="container py-3">
        <img src="{{ asset('assets/images/banner.jpg') }}" alt="" class="img-fluid">
    </div>
</section>
<section>
    <div class="container py-2 text-center">
        <h4>The <span class="text-danger"> Fiji Red Cross Society </span>is a humanitarian organization that provides assistance to vulnerable communities in Fiji. </h4>
        <h4>Our mission is to alleviate human suffering, promote health and well-being, and support disaster preparedness and response. </h4>
        <p>We work with volunteers, partners, and donors to deliver programs and services that address the needs of those most in need. </p>
        <p>Our organization is committed to upholding the fundamental principles of the Red Cross and Red Crescent Movement, including humanity, impartiality, neutrality, independence, voluntary service, unity, and universality.</p>
        <div class="hidden-lg">
            <div class="col text-center mb-3">
                <a class="btn btn-sm btn-info" href="{{ route('lodge-information.form') }}"><i class="mdi mdi-water text-danger me-1"></i>Signup for volunteer</a>
            </div>
            <div class="col text-center">
                <a class="btn btn-sm btn-info" href="{{ route('admin.login') }}"><i class="mdi mdi-login text-secondaqry me-1"></i>Department Login</a>
            </div>
        </div>
    </div>
</section>
<section class="sec" id="sec">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6 float-start dbtn hidden-sm">
                <div class="col text-center mb-3">
                    <a class="btn btn-sm btn-info db cb" href="{{ route('lodge-information.form') }}"><i class="mdi mdi-water text-danger me-1"></i>Signup for volunteer</a>
                </div>
                <div class="col text-center">
                    <a class="btn btn-sm btn-info sb cb" href="{{ route('admin.login') }}"><i class="mdi mdi-login text-secondaqry me-1"></i>Department Login</a>
                </div>

            </div>

            <div class="col-md-6 float-end">

                <div class="container">
                    <!--Auth fluid left content -->
                    <div class="auth-fluid-form-box pb-4 px-3">
                        <div class="align-items-center d-flex1 mt-4 h-100">
                            <div class="card">
                                <div class="card-body">

                                    <!-- title-->
                                    <h4 class="mt-0 text-center">Volunteer Login</h4>
                                    <p class="text-muted mb-4 text-center">Enter your email address and password to access account.</p>

                                    <!-- form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                            @error('email')
                                            <code id="email-error" class="text-danger">{{ $message }}</code>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-muted float-end"><small>Forgot
                                                    your password?</small></a>
                                            @endif
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                            @error('password')
                                            <code id="password-error" class="text-danger">{{ $message }}</code>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" id="checkbox-signin">
                                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="d-grid mb-0 text-center">
                                            <button class="btn btn-info" type="submit"><i class="mdi mdi-login"></i> Log In
                                            </button>
                                        </div>
                                    </form>
                                    <!-- end form-->

                                    <!-- Footer-->
                                    <!-- <footer class="footer footer-alt">
                                        <p class="text-muted">Don't have an account? <a href="{{ route('lodge-information.form') }}" class="text-muted ms-1"><b>Sign Up</b></a></p>
                                    </footer> -->

                                </div> <!-- end .card-body -->
                            </div>
                        </div> <!-- end .align-items-center.d-flex.h-100-->
                    </div>
                    <!-- end auth-fluid-form-box-->


                    <!-- end Auth fluid right content -->
                </div>
            </div>
        </div>
        <!-- end auth-fluid-->

    </div>
    <style>
        @media screen and (max-width: 600px) {
            .hidden-sm {
                display: none;
            }

            .hidden-lg {
                display: block !important;
            }
        }

        @media screen and (min-width: 768px) {
            .sec {
                background-color: red !important
            }
        }

        .hidden-lg {
            display: none;
        }

        .sec {
            background-color: #0acf970a !important
        }

        .dbtn {
            text-align: center;
            border-right: 2px solid black;
            height: 100%;
        }

        .cb {
            position: absolute;
            line-height: 30px;
        }

        .sb {

            top: 75%;
            font-size: 16px;
        }

        .db {

            top: 70%;
            font-size: 14.5px;
        }
    </style>
    <section>
        @endsection