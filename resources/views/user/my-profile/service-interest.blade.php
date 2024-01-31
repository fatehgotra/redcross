@extends('layouts.user')
@section('title', 'Volunteer | My Profile')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">My Profile</li>
                            <li class="breadcrumb-item active">Service Interest</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> My Profile</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link" href="{{ route('my-profile.lodge-information.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.personal-information.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.contact-information.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('my-profile.identification-and-employement-details.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.education-background.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.special-information.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link active show" href="{{ route('my-profile.service-interest.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.banking-information.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.consents-and-checks.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.receipts.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Receipts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Service Interest</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('my-profile.service-interest') }}" method="POST" id="serviceInterestForm">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="service_interest" class="col-form-label">Service Interest (Select all that
                                        applies) <span class="text-danger">*</span></label>
                                    <select id="service_interest"
                                        class="form-select select2 @error('service_interest') is-invalid @enderror"
                                        name="service_interest[]" data-toggle="select2"
                                        data-placeholder="Select Service Interest" multiple>
                                        <option value="">Select Service Interest(s)</option>
                                        <option value="Marketing"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Marketing') ? 'selected' : '' }}>
                                            Marketing
                                        </option>
                                        <option value="Communications"
                                        {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Communications') ? 'selected' : '' }}>
                                        Communications
                                        </option>
                                        <option value="Logistics"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Logistics') ? 'selected' : '' }}>
                                            Logistics
                                        </option>
                                        <option value="Disaster"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Disaster') ? 'selected' : '' }}>
                                            Disaster
                                        </option>
                                        <option value="Warehouse"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Warehouse') ? 'selected' : '' }}>
                                            Warehouse
                                        </option>
                                        <option value="Safety"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Safety') ? 'selected' : '' }}>
                                            Safety
                                        </option>
                                        <option value="Health & PGI"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Health & PGI') ? 'selected' : '' }}>
                                            Health & PGI
                                        </option>
                                        <option value="Legal"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Legal') ? 'selected' : '' }}>
                                            Legal
                                        </option>
                                        <option value="Administration"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Administration') ? 'selected' : '' }}>
                                            Administration
                                        </option>
                                        <option value="ICT"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('ICT') ? 'selected' : '' }}>
                                            ICT
                                        </option>
                                        <option value="Accounting"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Accounting') ? 'selected' : '' }}>
                                            Accounting
                                        </option>
                                    </select>
                                    @error('service_interest')
                                        <small id="service_interest-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="available_days" class="col-form-label">Which Days are you availlable ?
                                        (Select
                                        all that applies) <span class="text-danger">*</span></label>
                                    <select id="available_days"
                                        class="form-select select2 @error('available_days') is-invalid @enderror"
                                        name="available_days[]" data-toggle="select2" data-placeholder="Select Day(s)"
                                        multiple>
                                        <option value="">Select Day(s)</option>
                                        <option value="Monday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Monday') ? 'selected' : '' }}>
                                            Monday
                                        </option>
                                        <option value="Tuesday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Tuesday') ? 'selected' : '' }}>
                                            Tuesday
                                        </option>
                                        <option value="Wednesday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Wednesday') ? 'selected' : '' }}>
                                            Wednesday
                                        </option>
                                        <option value="Thursday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Thursday') ? 'selected' : '' }}>
                                            Thursday
                                        </option>
                                        <option value="Friday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Friday') ? 'selected' : '' }}>
                                            Friday
                                        </option>
                                        <option value="Saturday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Saturday') ? 'selected' : '' }}>
                                            Saturday
                                        </option>
                                        <option value="Sunday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Sunday') ? 'selected' : '' }}>
                                            Sunday
                                        </option>
                                    </select>
                                    @error('available_days')
                                        <small id="available_days-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="available_times" class="col-form-label">Which Times are you availlable ?
                                        (Select
                                        all that applies) <span class="text-danger">*</span></label>
                                    <select id="available_times"
                                        class="form-select select2 @error('available_times') is-invalid @enderror"
                                        name="available_times[]" data-toggle="select2" data-placeholder="Select Time(s)"
                                        multiple>
                                        <option value="">Select Time(s)</option>
                                        <option value="Morning: 06:00 AM to 10:00 AM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('Morning: 06:00 AM to 10:00 AM') ? 'selected' : '' }}>
                                            Morning: 06:00 AM to 10:00 AM
                                        </option>
                                        <option value="Midday: 10:00 AM to 02:00 PM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('Midday: 10:00 AM to 02:00 PM') ? 'selected' : '' }}>
                                            Midday: 10:00 AM to 02:00 PM
                                        </option>
                                        <option value="Mid-afternoon: 02:00 PM to 06:00 PM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('Mid-afternoon: 02:00 PM to 06:00 PM') ? 'selected' : '' }}>
                                            Mid-afternoon: 02:00 PM to 06:00 PM
                                        </option>
                                        <option value="After Hours: After 06:00 PM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('After Hours: After 06:00 PM') ? 'selected' : '' }}>
                                            After Hours: After 06:00 PM
                                        </option>
                                    </select>
                                    @error('available_times')
                                        <small id="available_times-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="other_skills" class="col-form-label">In the event of a disaster, what
                                        other skills can you support the team with?</label>
                                    <textarea name="other_skills" id="other_skills" class="form-control">{{ old('other_skills', isset($service_interest) ? $service_interest->other_skills : '') }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" form="serviceInterestForm"
                            class="btn btn-sm btn-success float-end">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
