@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card">               

                <div class="card-body">

                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Registration</h4>
                        <p class="text-muted mb-2">Final Step</p>
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
@endsection
