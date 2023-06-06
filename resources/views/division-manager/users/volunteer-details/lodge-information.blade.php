@extends('layouts.division-manager')
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
                            <li class="breadcrumb-item active">Lodgement Information</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Volunteer Details</h4>
                </div>
            </div>
        </div>
        @include('division-manager.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>  
                        </div>
                        <div class="float-end">
                            @if($user->status == 'approve')
                            <button class="btn btn-sm btn-success" disabled type="button"><i class="me-1 dripicons-checkmark"></i>Approved</button>
                            @elseif($user->status == 'decline')
                            <button class="btn btn-sm btn-danger" disabled type="button"><i class="me-1 dripicons-cross"></i>Declined</button>
                            @else
                            <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i class="me-1 dripicons-checkmark"></i>Approve</a>
                            
                            <a href="javascript:void(0);" onclick="confirmDecline()" class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>
                            <form id='approve-form'
                            action='{{ route('division-manager.change-status', $user->id) }}'
                            method='POST'>
                            <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                            <input type='hidden' name='status' value='approve'>
<input type='hidden' name='_method' value='PUT'>
                        </form>
                            <form id='decline-form'
                                action='{{ route('division-manager.change-status', $user->id) }}'
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
                            <a class="nav-link active show"
                                href="{{ route('division-manager.volunteer-detail.lodge-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.personal-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.contact-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('division-manager.volunteer-detail.identification-and-employement-details.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.education-background.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.special-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.service-interest.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.banking-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link" href="{{ route('division-manager.volunteer-detail.consents-and-checks.form', $user->id) }}">
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

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="date_of_lodgement" class="col-form-label">Date of Lodgement <span
                                        class="text-danger">*</span></label>
                                <input id="date_of_lodgement" type="date"
                                    class="form-control @error('date_of_lodgement') is-invalid @enderror"
                                    name="date_of_lodgement"
                                    value="{{ old('date_of_lodgement', isset($lodgement_information) ? $lodgement_information->date_of_lodgement : '') }}"
                                    autocomplete="date_of_lodgement" placeholder="Date of Lodgement" readonly autofocus>
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
                                    onkeypress="return isNumberKey(event)" maxlength="4" readonly>
                                @error('registering_year')
                                    <small id="registering_year-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="division" class="col-form-label">Division <span
                                        class="text-danger">*</span></label>
                                <select id="division" class="form-select @error('division') is-invalid @enderror"
                                    name="division" disabled>
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
                                            placeholder="Branch/Office Location E.g. Suva, Tuvaua etc." autofocus readonly>
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
                                    name="registration_location_type" disabled>
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
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('division-manager.volunteers.index') }}" class="btn btn-sm btn-dark float-end">Back</a>
                    </div>
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