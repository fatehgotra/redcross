@extends('layouts.app')
@section('title', 'Home | Fiji Red Cross Society')
@section('content')
    <section class="hero-section py-5">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-md-12 text-white text-center">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <h1><i class="mdi mdi-email-check noti-icon"></i></h1>
                    <h2> Verify Email Address</h2>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    <br>
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-link text-info p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection