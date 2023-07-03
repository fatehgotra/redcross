@extends('layouts.user')
@section('title', "Volunteer | My Profile")
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
                            <li class="breadcrumb-item active">Contact Information</li>
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
                    <a class="nav-link active show" href="{{ route('my-profile.contact-information.form') }}">
                        <i class="me-1 dripicons-chevron-right"></i>Contact Information
                    </a>   
                    <a class="nav-link" href="{{ route('my-profile.identification-and-employement-details.form') }}">
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
                <form action="{{ route('my-profile.contact-information') }}" method="POST" id="contactInformationForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Contact Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="resedential_address" class="col-form-label">Residential Address (Usual pace of
                                        Residence) <span class="text-danger">*</span></label>
                                    <input type="text" id="resedential_address"
                                        class="form-control @error('resedential_address') is-invalid @enderror"
                                        name="resedential_address" autocomplete="resedential_address"
                                        placeholder="Residential Address" autofocus value="{{ old('resedential_address', isset($contact_information) ? $contact_information->resedential_address : '') }}">
                                    @error('resedential_address')
                                        <small id="resedential_address-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="community_name" class="col-form-label">Community name (applicable to CBV's)<span
                                            class="text-danger">*</span></label>
                                    <input id="community_name" type="text"
                                        class="form-control @error('community_name') is-invalid @enderror" name="community_name"
                                        value="{{ old('community_name', isset($contact_information) ? $contact_information->community_name : '') }}" autocomplete="community_name"
                                        placeholder="Community name">
                                    @error('community_name')
                                        <small id="community_name-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="community_type" class="col-form-label">Community Type <span
                                            class="text-danger">*</span></label>
                                    <select id="community_type"
                                        class="form-select @error('community_type') is-invalid @enderror" name="community_type">
                                        <option value="">Select Community Type</option>
                                        <option value="Village" {{ old('community_type', isset($contact_information) ? $contact_information->community_type : '') == 'Village' ? 'selected' : '' }}>
                                            Village
                                        </option>
                                        <option value="Settlement"
                                            {{ old('community_type', isset($contact_information) ? $contact_information->community_type : '') == 'Settlement' ? 'selected' : '' }}>Settlement
                                        </option>
                                        <option value="Compound" {{ old('community_type', isset($contact_information) ? $contact_information->community_type : '') == 'Compound' ? 'selected' : '' }}>
                                            Compound
                                        </option>
                                        <option value="Suburb" {{ old('community_type', isset($contact_information) ? $contact_information->community_type : '') == 'Suburb' ? 'selected' : '' }}>Suburb
                                        </option>
                                        <option value="Town" {{ old('community_type', isset($contact_information) ? $contact_information->community_type : '') == 'Town' ? 'selected' : '' }}>Town
                                        </option>
                                        <option value="Farm / Estate"
                                            {{ old('community_type', isset($contact_information) ? $contact_information->community_type : '') == 'Farm / Estate' ? 'selected' : '' }}>Farm / Estate
                                        </option>
                                    </select>
                                    @error('community_type')
                                        <small id="community_type-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="province" class="col-form-label">Province<span
                                            class="text-danger">*</span></label>
                                    <input id="province" type="text"
                                        class="form-control @error('province') is-invalid @enderror" name="province"
                                        value="{{ old('province', isset($contact_information) ? $contact_information->province : '') }}" autocomplete="province" placeholder="Province">
                                    @error('province')
                                        <small id="province-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="district" class="col-form-label">District / Tikina<span
                                            class="text-danger">*</span></label>
                                    <input id="district" type="text"
                                        class="form-control @error('district') is-invalid @enderror" name="district"
                                        value="{{ old('district', isset($contact_information) ? $contact_information->district : '') }}" autocomplete="district" placeholder="District / Tikina">
                                    @error('district')
                                        <small id="district-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="postal_address" class="col-form-label">Postal Address<span
                                            class="text-danger">*</span></label>
                                    <input id="postal_address" type="text"
                                        class="form-control @error('postal_address') is-invalid @enderror" name="postal_address"
                                        value="{{ old('postal_address', isset($contact_information) ? $contact_information->postal_address : '') }}" autocomplete="postal_address"
                                        placeholder="Postal Address">
                                    @error('postal_address')
                                        <small id="postal_address-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="email" class="col-form-label">Email Contact<span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', isset($contact_information) ? $contact_information->email : '') }}" autocomplete="email" placeholder="Email Contact">
                                    @error('email')
                                        <small id="email-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="landline_contact" class="col-form-label">Landline Contact <span
                                            class="text-danger">*</span></label>
                                    <input id="landline_contact" type="text"
                                        class="form-control @error('landline_contact') is-invalid @enderror"
                                        name="landline_contact" value="{{ old('landline_contact', isset($contact_information) ? $contact_information->landline_contact : '') }}"
                                        autocomplete="landline_contact" placeholder="Landline Contact"
                                        onkeypress="return isNumberKey(event)" maxlength="12">
                                    @error('landline_contact')
                                        <small id="landline_contact-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="primary_mobile_contact_number" class="col-form-label">Primary Mobile Contact
                                        Number <span class="text-danger">*</span></label>
                                    <input id="primary_mobile_contact_number" type="text"
                                        class="form-control @error('primary_mobile_contact_number') is-invalid @enderror"
                                        name="primary_mobile_contact_number"
                                        value="{{ old('primary_mobile_contact_number', isset($contact_information) ? $contact_information->primary_mobile_contact_number : '') }}"
                                        autocomplete="primary_mobile_contact_number"
                                        placeholder="Primary Mobile Contact Number" onkeypress="return isNumberKey(event)"
                                        maxlength="12">
                                    @error('primary_mobile_contact_number')
                                        <small id="primary_mobile_contact_number-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <div class="col-lg-6">
                                    <label for="primary_mobile_network_provider" class="col-form-label">Primary Mobile Network
                                        Provider <span class="text-danger">*</span></label>
                                    <select id="primary_mobile_network_provider"
                                        class="form-select @error('primary_mobile_network_provider') is-invalid @enderror"
                                        name="primary_mobile_network_provider">
                                        <option value="">Select Network Provider</option>
                                        <option value="Vodafone"
                                            {{ old('primary_mobile_network_provider', isset($contact_information) ? $contact_information->primary_mobile_network_provider : '') == 'Vodafone' ? 'selected' : '' }}>
                                            Vodafone
                                        </option>
                                        <option value="Inkk"
                                            {{ old('primary_mobile_network_provider', isset($contact_information) ? $contact_information->primary_mobile_network_provider : '') == 'Inkk' ? 'selected' : '' }}>Inkk
                                        </option>
                                        <option value="Digicel"
                                            {{ old('primary_mobile_network_provider', isset($contact_information) ? $contact_information->primary_mobile_network_provider : '') == 'Digicel' ? 'selected' : '' }}>
                                            Digicel
                                        </option>
                                    </select>
                                    @error('primary_mobile_network_provider')
                                        <small id="primary_mobile_contact_number-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}
                                <div class="col-lg-6">
                                    <label for="other_contact_numbers" class="col-form-label">Other Contact Numbers</label>
                                    <input id="other_contact_numbers" type="text"
                                        class="form-control @error('other_contact_numbers') is-invalid @enderror"
                                        name="other_contact_numbers" value="{{ old('other_contact_numbers', isset($contact_information) ? $contact_information->other_contact_numbers : '') }}"
                                        autocomplete="other_contact_numbers" placeholder="Landline Contact"
                                        onkeypress="return isNumberKey(event)" maxlength="12">
                                    @error('other_contact_numbers')
                                        <small id="other_contact_numbers-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Emergency Contact </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
    
                                <div class="col-lg-6">
                                    <label for="full_name_of_emergency_contact" class="col-form-label">Full Name of Emergency <span class="text-danger">*</span>
                                        Contact</label>
                                    <input id="full_name_of_emergency_contact" type="text"
                                        class="form-control @error('full_name_of_emergency_contact') is-invalid @enderror"
                                        name="full_name_of_emergency_contact"
                                        value="{{ old('full_name_of_emergency_contact', isset($contact_information) ? $contact_information->full_name_of_emergency_contact : '') }}"
                                        autocomplete="full_name_of_emergency_contact"
                                        placeholder="Full Name of Emergency Contact">
                                    @error('full_name_of_emergency_contact')
                                        <small id="full_name_of_emergency_contact-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="relationship" class="col-form-label">Relationship <span class="text-danger">*</span></label>
                                    <input id="relationship" type="text"
                                        class="form-control @error('relationship') is-invalid @enderror" name="relationship"
                                        value="{{ old('relationship', isset($contact_information) ? $contact_information->relationship : '') }}" autocomplete="relationship"
                                        placeholder="Relationship">
                                    @error('relationship')
                                        <small id="registering_year-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="resedential_address_separate" class="col-form-label">Resedential Address (If
                                        residing in a separate household)</label>
                                    <input id="resedential_address_separate" type="text"
                                        class="form-control @error('resedential_address_separate') is-invalid @enderror"
                                        name="resedential_address_separate" value="{{ old('resedential_address_separate', isset($contact_information) ? $contact_information->resedential_address_separate : '') }}"
                                        autocomplete="resedential_address_separate" placeholder="Resedential Address">
                                    @error('resedential_address_separate')
                                        <small id="resedential_address_separate-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="contact_number" class="col-form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input id="contact_number" type="text"
                                        class="form-control @error('contact_number') is-invalid @enderror"
                                        name="contact_number" value="{{ old('contact_number', isset($contact_information) ? $contact_information->contact_number : '') }}"
                                        autocomplete="contact_number" placeholder="Contact Number">
                                    @error('contact_number')
                                        <small id="contact_number-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" form="contactInformationForm"
                                class="btn btn-sm btn-success float-end">Update</button>
                        </div>
                </form>
            </div>
        </div>   
    </div>
@endsection