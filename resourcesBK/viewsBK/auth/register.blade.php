@php
    $personal_information = Session::get('personal-information');
    $contact_information = Session::get('contact-information');
@endphp
@extends('layouts.app')
@section('title', 'Volunteer Registration | Fiji Red Cross Society')
@section('content')
    <section>
        <div class="container pt-3">
            <h3 class="text-center">Volunteer Registration</h3>
        </div>
    </section>
    <section>
        <div class="container pt-3">
            <div class="card">
                <div class="card-header">
                    <p class="text-center text-muted">Final Step</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-6 mb-2">
                                <label for="firstname" class="col-form-label text-md-end">{{ __('Firstname') }} <span
                                        class="text-danger">*</span></label>
                                <input id="firstname" type="text"
                                    class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                    value="{{ old('firstname', isset($personal_information) ? $personal_information['firstname'] : '') }}"
                                    autocomplete="firstname" autofocus placeholder="Firstname">
                                @error('firstname')
                                    <code id="firstname-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label for="lastname" class="col-form-label text-md-end">{{ __('Lastname') }} <span
                                        class="text-danger">*</span></label>
                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                    value="{{ old('lastname', isset($personal_information) ? $personal_information['lastname'] : '') }}"
                                    autocomplete="lastname" autofocus placeholder="Lastname">
                                @error('lastname')
                                    <code id="lastname-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email" id="emailaddress"
                                    placeholder="Enter your email"
                                    value="{{ old('email', isset($contact_information) ? $contact_information['email'] : '') }}"
                                    autocomplete="off">
                                @error('email')
                                    <code id="email-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input class="form-control" type="text" name="phone" id="phone"
                                    placeholder="Enter your Phone Number"
                                    value="{{ old('phone', isset($contact_information) ? $contact_information['primary_mobile_contact_number'] : '') }}">
                                @error('phone')
                                    <code id="phone-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-2">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Set your password" autocomplete="off">
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
                        </div>


                        <div class="mb-0 text-center">
                            <p class="text-muted mt-1">Already have an account? <a href="{{ route('login') }}"
                                    class="text-muted ms-1"><b>Login</b></a></p>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('consents-and-checks.form') }}" class="btn btn-sm btn-warning float-start">Previous
                        Step</a>
                    <button type="submit" form="registrationForm" class="btn btn-sm btn-success float-end">Finish
                        Registration</button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-1 pb-3">
            <ul>
                <li>
                    Please note that all the information bothered here is treated as "Confidential". Information will only
                    be
                    used for the management of members and volunteers and access Is limited to <strong> authorised persons
                        only.</strong>
                </li>
                <li>Volunteers will have to re-register if inactive for more than 2 years</li>
            </ul>
        </div>
    </section>
@endsection
