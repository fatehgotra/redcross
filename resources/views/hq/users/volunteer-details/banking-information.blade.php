@extends('layouts.hq')
@section('title', 'Volunteer Details')
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
                            <li class="breadcrumb-item">Volunteer Details</li>
                            <li class="breadcrumb-item active">Banking Information</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Volunteer Details</h4>
                </div>
            </div>
        </div>
        @include('hq.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>  
                        </div>
                        <div class="float-end">
                            @if($user->status == 'approve' && $user->approved_by == 'HQ')
                            <button class="btn btn-sm btn-success" disabled type="button"><i class="me-1 dripicons-checkmark"></i>Approved</button>
                            @elseif($user->status == 'decline' && $user->approved_by == 'HQ')
                            <button class="btn btn-sm btn-danger" disabled type="button"><i class="me-1 dripicons-cross"></i>Declined</button>
                            @else
                            <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i class="me-1 dripicons-checkmark"></i>Approve</a>
                            
                            <a href="javascript:void(0);" onclick="confirmDecline()" class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>
                            <form id='approve-form'
                            action='{{ route('hq.change-status', $user->id) }}'
                            method='POST'>
                            <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                            <input type='hidden' name='status' value='approve'>
<input type='hidden' name='_method' value='PUT'>
                        </form>
                            <form id='decline-form'
                                action='{{ route('hq.change-status', $user->id) }}'
                                method='POST'>
                                <input type='hidden' name='_token'
                                    value='{{ csrf_token() }}'>
                                <input type='hidden' name='status' value='decline'>
<input type='hidden' name='_method' value='PUT'>
                            </form>
                            @endif
                        </div>                      
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.lodge-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.personal-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.contact-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('hq.volunteer-detail.identification-and-employement-details.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.education-background.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.special-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.service-interest.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link active show" href="{{ route('hq.volunteer-detail.banking-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.consents-and-checks.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-sm-9">                    
                        <div class="card">
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
                                            name="bank" disabled>
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
                                            autocomplete="account_number" placeholder="Account Number" readonly>
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
                                            autocomplete="name_bank_account" readonly placeholder="Name as used with Bank Account">
                                        @error('name_bank_account')
                                            <small id="name_bank_account-error"
                                                class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            name="mobile_bank" disabled>
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
                                            placeholder="Mobile Number registered with Mobile banking Service" readonly>
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
                                            placeholder="Name as registered with Mobile banking Service" readonly>
                                        @error('name_mobile_bank_account')
                                            <small id="name_mobile_bank_account-error"
                                                class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('hq.volunteers.index') }}" class="btn btn-sm btn-dark float-end">Back</a>
                            </div>

                </div>
            </div>
        </div>
    @endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function confirmAccept(no) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve Volunteer!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('approve-form').submit();
            }
        })
    };
</script>
<script type="text/javascript">
    function confirmDecline(no) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Decline Volunteer!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('decline-form').submit();
            }
        })
    };
</script>
@endpush