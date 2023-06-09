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
                            <li class="breadcrumb-item active">Lodgement Information</li>
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
                            <a class="nav-link active show" href="{{ route('my-profile.lodge-information.form') }}">
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
                            <a class="nav-link" href="{{ route('my-profile.service-interest.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.banking-information.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link" href="{{ route('my-profile.consents-and-checks.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Lodgement Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('my-profile.lodge-information') }}" method="POST"
                            id="lodgeInformationForm">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="date_of_lodgement" class="col-form-label">Date of Lodgement <span
                                            class="text-danger">*</span></label>
                                    <input id="date_of_lodgement" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" 
                                        class="form-control @error('date_of_lodgement') is-invalid @enderror"
                                        name="date_of_lodgement"
                                        value="{{ old('date_of_lodgement', isset($lodgement_information) ? $lodgement_information->date_of_lodgement : '') }}"
                                        autocomplete="date_of_lodgement" placeholder="Date of Lodgement" autofocus>
                                    @error('date_of_lodgement')
                                        <small id="date_of_lodgement-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="registering_year" class="col-form-label">Registering Year <span
                                            class="text-danger">*</span></label>
                                    <input id="registering_year" type="text"
                                        class="form-control @error('registering_year') is-invalid @enderror"
                                        name="registering_year"
                                        value="{{ old('registering_year', isset($lodgement_information) ? $lodgement_information->registering_year : '') }}"
                                        autocomplete="registering_year" placeholder="Registering Year"
                                        onkeypress="return isNumberKey(event)" maxlength="4">
                                    @error('registering_year')
                                        <small id="registering_year-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="division" class="col-form-label">Division <span
                                            class="text-danger">*</span></label>
                                    <select id="division" class="form-select @error('division') is-invalid @enderror"
                                        name="division">
                                        <option value="">Select Division</option>
                                        <option value="Central / Eastern"
                                            {{ old('division', isset($lodgement_information) ? $lodgement_information->division : '') == 'Central / Eastern' ? 'selected' : '' }}>
                                            Central / Eastern
                                        </option>
                                        <option value="Western"
                                            {{ old('division', isset($lodgement_information) ? $lodgement_information->division : '') == 'Western' ? 'selected' : '' }}>
                                            Western
                                        </option>
                                        <option value="Northern"
                                            {{ old('division', isset($lodgement_information) ? $lodgement_information->division : '') == 'Northern' ? 'selected' : '' }}>
                                            Northern
                                        </option>
                                    </select>
                                    @error('division')
                                        <small id="division-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="registration_location" class="col-form-label">Registration Location <span
                                            class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="registration_location" type="text"
                                                class="form-control @error('registration_location') is-invalid @enderror"
                                                name="registration_location"
                                                value="{{ old('registration_location', isset($lodgement_information) ? $lodgement_information->registration_location : '') }}"
                                                autocomplete="registration_location"
                                                placeholder="Branch/Office Location E.g. Suva, Tuvaua etc." autofocus>
                                            @error('registration_location')
                                                <small id="registration_location-error"
                                                    class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="registration_location_type" class="col-form-label">Registration Location
                                        Type<span class="text-danger">*</span></label>
                                    <select id="registration_location_type"
                                        class="form-select @error('registration_location_type') is-invalid @enderror"
                                        name="registration_location_type">
                                        <option value="Branch"
                                            {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information->registration_location_type : '') == 'Branch' ? 'selected' : '' }}>
                                            Branch
                                        </option>
                                        <option value="National Office"
                                            {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information->registration_location_type : '') == 'National Office' ? 'selected' : '' }}>
                                            National Office
                                        </option>
                                    </select>
                                    @error('registration_location_type')
                                        <small id="registration_location_type-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" form="lodgeInformationForm"
                            class="btn btn-sm btn-success float-end">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
