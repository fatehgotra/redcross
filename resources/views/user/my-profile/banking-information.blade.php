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
                            <li class="breadcrumb-item active">Banking Information</li>
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
                            <a class="nav-link" href="{{ route('my-profile.service-interest.form') }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link active show" href="{{ route('my-profile.banking-information.form') }}">
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
                    <form action="{{ route('my-profile.banking-information') }}" method="POST"
                        id="bankingInformationForm">
                        @csrf
                        {{-- <div class="card">
                            <div class="card-header">
                                <h4 class="header-title text-center fw-bold">Personal Banking Information (Optional with
                                    Mobile Banking)</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="bank" class="col-form-label">Bank <span
                                                class="text-danger">*</span></label>
                                        <select id="bank" class="form-select @error('bank') is-invalid @enderror"
                                            name="bank">
                                            <option value="">Select Bank</option>
                                            <option value="Bank of South Pacific (BSP)"
                                                {{ old('bank', isset($personal_banking_information) ? $personal_banking_information->bank : '') == 'Bank of South Pacific (BSP)' ? 'selected' : '' }}>
                                                Bank of South Pacific (BSP)
                                            </option>
                                            <option value="Australia & New Zealand Banking Group (ANZ)"
                                                {{ old('bank', isset($personal_banking_information) ? $personal_banking_information->bank : '') == 'Australia & New Zealand Banking Group (ANZ)' ? 'selected' : '' }}>
                                                Australia & New Zealand Banking Group (ANZ)
                                            </option>
                                            <option value="Home Finance Company Bank (HFC)"
                                                {{ old('bank', isset($personal_banking_information) ? $personal_banking_information->bank : '') == 'Home Finance Company Bank (HFC)' ? 'selected' : '' }}>
                                                Home Finance Company Bank (HFC)
                                            </option>
                                            <option value="Bank of Baroda"
                                                {{ old('bank', isset($personal_banking_information) ? $personal_banking_information->bank : '') == 'Bank of Baroda' ? 'selected' : '' }}>
                                                Bank of Baroda
                                            </option>
                                            <option value="Westpac"
                                                {{ old('bank', isset($personal_banking_information) ? $personal_banking_information->bank : '') == 'Westpac' ? 'selected' : '' }}>
                                                Westpac
                                            </option>
                                            <option value="BRED bank"
                                                {{ old('bank', isset($personal_banking_information) ? $personal_banking_information->bank : '') == 'BRED bank' ? 'selected' : '' }}>
                                                BRED bank
                                            </option>
                                        </select>
                                        @error('bank')
                                            <small id="bank-error" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="account_number" class="col-form-label">Account Number <span
                                                class="text-danger">*</span></label>
                                        <input id="account_number" type="text"
                                            class="form-control @error('account_number') is-invalid @enderror"
                                            name="account_number"
                                            value="{{ old('account_number', isset($personal_banking_information) ? $personal_banking_information->account_number : '') }}"
                                            autocomplete="account_number" placeholder="Account Number">
                                        @error('account_number')
                                            <small id="account_number-error" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="name_bank_account" class="col-form-label">Name as used with Bank Account
                                            <span class="text-danger">*</span></label>
                                        <input id="name_bank_account" type="text"
                                            class="form-control @error('name_bank_account') is-invalid @enderror"
                                            name="name_bank_account"
                                            value="{{ old('name_bank_account', isset($personal_banking_information) ? $personal_banking_information->name_bank_account : '') }}"
                                            autocomplete="name_bank_account" placeholder="Name as used with Bank Account">
                                        @error('name_bank_account')
                                            <small id="name_bank_account-error"
                                                class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title text-center fw-bold">Mobile Banking Information (Optional with
                                    Personal Banking) </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <i>* Please ensure phone number is registered to you</i>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="mobile_bank" class="col-form-label">Mobile Bank <span
                                                class="text-danger">*</span></label>
                                        <select id="mobile_bank"
                                            class="form-select @error('mobile_bank') is-invalid @enderror"
                                            name="mobile_bank">
                                            <option value="">Select Mobile Bank</option>
                                            <option value="Vodafone MPAISA"
                                                {{ old('mobile_bank', isset($mobile_banking_information) ? $mobile_banking_information->mobile_bank : '') == 'Vodafone MPAISA' ? 'selected' : '' }}>
                                                Vodafone MPAISA
                                            </option>
                                            <option value="Digicel MyCash"
                                                {{ old('mobile_bank', isset($mobile_banking_information) ? $mobile_banking_information->mobile_bank : '') == 'Digicel MyCash' ? 'selected' : '' }}>
                                                Digicel MyCash
                                            </option>
                                        </select>
                                        @error('mobile_bank')
                                            <small id="mobile_bank-error" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="mobile_bank_number" class="col-form-label">Mobile Number registered
                                            with Mobile banking Service <span class="text-danger">*</span></label>
                                        <input id="mobile_bank_number" type="text"
                                            class="form-control @error('mobile_bank_number') is-invalid @enderror"
                                            name="mobile_bank_number"
                                            value="{{ old('mobile_bank_number', isset($mobile_banking_information) ? $mobile_banking_information->mobile_bank_number : '') }}"
                                            autocomplete="mobile_bank_number"
                                            placeholder="Mobile Number registered with Mobile banking Service">
                                        @error('mobile_bank_number')
                                            <small id="mobile_bank_number-error"
                                                class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="name_mobile_bank_account" class="col-form-label">Name as registered
                                            with Mobile banking Service <span class="text-danger">*</span></label>
                                        <input id="name_mobile_bank_account" type="text"
                                            class="form-control @error('name_mobile_bank_account') is-invalid @enderror"
                                            name="name_mobile_bank_account"
                                            value="{{ old('name_mobile_bank_account', isset($mobile_banking_information) ? $mobile_banking_information->name_mobile_bank_account : '') }}"
                                            autocomplete="name_mobile_bank_account"
                                            placeholder="Name as registered with Mobile banking Service">
                                        @error('name_mobile_bank_account')
                                            <small id="name_mobile_bank_account-error"
                                                class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" form="bankingInformationForm"
                                    class="btn btn-sm btn-success float-end">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
