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
                            <li class="breadcrumb-item active">Identification & Employment Details</li>
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
                            <a class="nav-link active show"
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
                            <a class="nav-link" href="{{ route('my-profile.receipts.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Receipts
                                </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <form action="{{ route('my-profile.identification-and-employement-details') }}" method="POST"
                    id="identificationAndEmployementDetailsForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Valid National Identification</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="photo_id_card_type" class="col-form-label">Photo ID Card Type <span
                                            class="text-danger">*</span></label>
                                    <select id="photo_id_card_type"
                                        class="form-select @error('photo_id_card_type') is-invalid @enderror"
                                        name="photo_id_card_type">
                                        <option value="">Select Photo ID Card Type</option>
                                        <option value="Drivers License"
                                            {{ old('photo_id_card_type', isset($identification_details) ? $identification_details->photo_id_card_type : '') == 'Drivers License' ? 'selected' : '' }}>
                                            Drivers License
                                        </option>
                                        <option value="Passport"
                                            {{ old('photo_id_card_type', isset($identification_details) ? $identification_details->photo_id_card_type : '') == 'Passport' ? 'selected' : '' }}>
                                            Passport
                                        </option>
                                        <option value="FNPF-TIN Joint Card"
                                            {{ old('photo_id_card_type', isset($identification_details) ? $identification_details->photo_id_card_type : '') == 'FNPF-TIN Joint Card' ? 'selected' : '' }}>
                                            FNPF-TIN Joint Card
                                        </option>
                                        <option value="Student ID"
                                            {{ old('photo_id_card_type', isset($identification_details) ? $identification_details->photo_id_card_type : '') == 'Student ID' ? 'selected' : '' }}>
                                            Student ID
                                        </option>
                                        <option value="Voter ID"
                                            {{ old('photo_id_card_type', isset($identification_details) ? $identification_details->photo_id_card_type : '') == 'Voter ID' ? 'selected' : '' }}>
                                            Voter ID
                                        </option>
                                        <option value="Other"
                                            {{ old('photo_id_card_type', isset($identification_details) ? $identification_details->photo_id_card_type : '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('photo_id_card_type')
                                        <small id="photo_id_card_type-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="specify_photo_id_card_type" class="col-form-label">Specify Photo ID Card (If
                                        any
                                        other)</label>
                                    <input id="specify_photo_id_card_type" type="text"
                                        class="form-control @error('specify_photo_id_card_type') is-invalid @enderror"
                                        name="specify_photo_id_card_type"
                                        value="{{ old('specify_photo_id_card_type', isset($identification_details) ? $identification_details->specify_photo_id_card_type : '') }}"
                                        autocomplete="specify_photo_id_card_type"
                                        placeholder="Specify Photo ID Card (If any other)">
                                    @error('specify_photo_id_card_type')
                                        <small id="specify_photo_id_card_type-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="id_card_number" class="col-form-label">ID Card Number<span
                                            class="text-danger">*</span></label>
                                    <input id="id_card_number" type="text"
                                        class="form-control @error('id_card_number') is-invalid @enderror"
                                        name="id_card_number"
                                        value="{{ old('id_card_number', isset($identification_details) ? $identification_details->id_card_number : '') }}"
                                        autocomplete="id_card_number" placeholder="ID Card Number">
                                    @error('id_card_number')
                                        <small id="id_card_number-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="id_expiry_date" class="col-form-label">ID Expiry Date<span
                                            class="text-danger">*</span></label>
                                    <input id="id_expiry_date" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" 
                                        class="form-control @error('id_expiry_date') is-invalid @enderror"
                                        name="id_expiry_date"
                                        value="{{ old('id_expiry_date', isset($identification_details) ? $identification_details->id_expiry_date : '') }}"
                                        autocomplete="id_expiry_date" placeholder="ID Card Number">
                                    @error('id_expiry_date')
                                        <small id="id_expiry_date-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="tin" class="col-form-label">TIN<span
                                            class="text-danger">*</span></label>
                                    <input id="tin" type="text"
                                        class="form-control @error('tin') is-invalid @enderror" name="tin"
                                        value="{{ old('tin', isset($identification_details) ? $identification_details->tin : '') }}"
                                        autocomplete="tin" placeholder="TIN">
                                    @error('tin')
                                        <small id="tin-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="photo_id" class="col-form-label">Upload Photo ID</label>
                                    <div class="input-group">
                                        <input id="photo_id" type="file"
                                            class="form-control @error('photo_id') is-invalid @enderror" name="photo_id">
                                        @isset($identification_details->photo_id)
                                            <a href="{{ asset('storage/uploads/users/'.Auth::user()->id.'/' . $identification_details->photo_id) }}"
                                                download="" class="btn btn-warning download-label"><i
                                                    class="mdi mdi-download"></i></a>
                                        @endisset
                                    </div>
                                    @error('photo_id')
                                        <small id="photo_id-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Employment Details </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">

                                <div class="col-lg-12">
                                    <label for="current_employment_status" class="col-form-label">Current Employment
                                        Status <span class="text-danger">*</span></label>
                                    <select id="current_employment_status"
                                        class="form-select @error('current_employment_status') is-invalid @enderror"
                                        name="current_employment_status">
                                        <option value="">Select Current Employment Status</option>
                                        <option value="Employed"
                                            {{ old('current_employment_status', isset($employment_details) ? $employment_details->current_employment_status : '') == 'Employed' ? 'selected' : '' }}>
                                            Employed
                                        </option>
                                        <option value="Not-Employed"
                                            {{ old('current_employment_status', isset($employment_details) ? $employment_details->current_employment_status : '') == 'Not-Employed' ? 'selected' : '' }}>
                                            Not-Employed
                                        </option>
                                        <option value="Student"
                                            {{ old('current_employment_status', isset($employment_details) ? $employment_details->current_employment_status : '') == 'Student' ? 'selected' : '' }}>
                                            Student
                                        </option>
                                        <option value="Retired / Pensioner"
                                            {{ old('current_employment_status', isset($employment_details) ? $employment_details->current_employment_status : '') == 'Retired / Pensioner' ? 'selected' : '' }}>
                                            Retired / Pensioner
                                        </option>
                                        <option value="Self-Employed"
                                            {{ old('current_employment_status', isset($employment_details) ? $employment_details->current_employment_status : '') == 'Self-Employed' ? 'selected' : '' }}>
                                            Self-Employed
                                        </option>
                                    </select>
                                    @error('current_employment_status')
                                        <small id="current_employment_status-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="current_occupation" class="col-form-label">Current Occupation <span>(If
                                            Employed / Self Employed)</span></label>
                                    <input id="current_occupation" type="text"
                                        class="form-control @error('current_occupation') is-invalid @enderror"
                                        name="current_occupation"
                                        value="{{ old('current_occupation', isset($employment_details) ? $employment_details->current_occupation : '') }}"
                                        autocomplete="current_occupation" placeholder="Current Occupation">
                                    @error('current_occupation')
                                        <small id="current_occupation-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="organisation_name" class="col-form-label">Organisation Name <span>(If
                                            Employed / Self Employed)</span></label>
                                    <input id="organisation_name" type="text"
                                        class="form-control @error('organisation_name') is-invalid @enderror"
                                        name="organisation_name"
                                        value="{{ old('organisation_name', isset($employment_details) ? $employment_details->organisation_name : '') }}"
                                        autocomplete="organisation_name" placeholder="Organisation Name">
                                    @error('organisation_name')
                                        <small id="organisation_name-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="organisation_address" class="col-form-label">Organisation Address
                                        <span>(If Employed / Self Employed)</span></label>
                                    <input id="organisation_address" type="text"
                                        class="form-control @error('organisation_address') is-invalid @enderror"
                                        name="organisation_address"
                                        value="{{ old('organisation_address', isset($employment_details) ? $employment_details->organisation_address : '') }}"
                                        autocomplete="organisation_address" placeholder="Organisation Address">
                                    @error('organisation_address')
                                        <small id="organisation_address-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="work_contact_number" class="col-form-label">Work Contact Number <span>(If
                                            Employed / Self Employed)</span></label>
                                    <input id="work_contact_number" type="text"
                                        class="form-control @error('work_contact_number') is-invalid @enderror"
                                        name="work_contact_number"
                                        value="{{ old('work_contact_number', isset($employment_details) ? $employment_details->work_contact_number : '') }}"
                                        autocomplete="work_contact_number" placeholder="Work Contact Number">
                                    @error('work_contact_number')
                                        <small id="work_contact_number-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" form="identificationAndEmployementDetailsForm"
                                class="btn btn-sm btn-success float-end">Update</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
