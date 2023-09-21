@php
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
            <form action="{{ route('contact-information') }}" method="POST" id="contactInformationForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Contact Information</h4>
                        <p class="text-center text-muted">Step 3</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="resedential_address" class="col-form-label">Residential Address (Usual pace of
                                    Residence) <span class="text-danger">*</span></label>
                                <input type="text" id="resedential_address"
                                    class="form-control @error('resedential_address') is-invalid @enderror"
                                    name="resedential_address" autocomplete="resedential_address"
                                    placeholder="Residential Address" autofocus value="{{ old('resedential_address', isset($contact_information) ? $contact_information['resedential_address'] : '') }}">
                                @error('resedential_address')
                                    <small id="resedential_address-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="community_name" class="col-form-label">Community name (applicable to CBV's)<span
                                        class="text-danger">*</span></label>
                                <input id="community_name" type="text"
                                    class="form-control @error('community_name') is-invalid @enderror" name="community_name"
                                    value="{{ old('community_name', isset($contact_information) ? $contact_information['community_name'] : '') }}" autocomplete="community_name"
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
                                    <option value="Village" {{ old('community_type', isset($contact_information) ? $contact_information['community_type'] : '') == 'Village' ? 'selected' : '' }}>
                                        Village
                                    </option>
                                    <option value="Settlement"
                                        {{ old('community_type', isset($contact_information) ? $contact_information['community_type'] : '') == 'Settlement' ? 'selected' : '' }}>Settlement
                                    </option>
                                    <option value="Compound" {{ old('community_type', isset($contact_information) ? $contact_information['community_type'] : '') == 'Compound' ? 'selected' : '' }}>
                                        Compound
                                    </option>
                                    <option value="Suburb" {{ old('community_type', isset($contact_information) ? $contact_information['community_type'] : '') == 'Suburb' ? 'selected' : '' }}>Suburb
                                    </option>
                                    <option value="Town" {{ old('community_type', isset($contact_information) ? $contact_information['community_type'] : '') == 'Town' ? 'selected' : '' }}>Town
                                    </option>
                                    <option value="Farm / Estate"
                                        {{ old('community_type', isset($contact_information) ? $contact_information['community_type'] : '') == 'Farm / Estate' ? 'selected' : '' }}>Farm / Estate
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
                                    value="{{ old('province', isset($contact_information) ? $contact_information['province'] : '') }}" autocomplete="province" placeholder="Province">
                                @error('province')
                                    <small id="province-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="district" class="col-form-label">District / Tikina<span
                                        class="text-danger">*</span></label>
                                <input id="district" type="text"
                                    class="form-control @error('district') is-invalid @enderror" name="district"
                                    value="{{ old('district', isset($contact_information) ? $contact_information['district'] : '') }}" autocomplete="district" placeholder="District / Tikina">
                                @error('district')
                                    <small id="district-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="postal_address" class="col-form-label">Postal Address<span
                                        class="text-danger">*</span></label>
                                <input id="postal_address" type="text"
                                    class="form-control @error('postal_address') is-invalid @enderror" name="postal_address"
                                    value="{{ old('postal_address', isset($contact_information) ? $contact_information['postal_address'] : '') }}" autocomplete="postal_address"
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
                                    value="{{ old('email', isset($contact_information) ? $contact_information['email'] : '') }}" autocomplete="email" placeholder="Email Contact">
                                @error('email')
                                    <small id="email-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="landline_contact" class="col-form-label">Landline Contact <span
                                        class="text-danger">*</span></label>
                                <input id="landline_contact" type="text"
                                    class="form-control @error('landline_contact') is-invalid @enderror"
                                    name="landline_contact" value="{{ old('landline_contact', isset($contact_information) ? $contact_information['landline_contact'] : '') }}"
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
                                    value="{{ old('primary_mobile_contact_number', isset($contact_information) ? $contact_information['primary_mobile_contact_number'] : '') }}"
                                    autocomplete="primary_mobile_contact_number"
                                    placeholder="Primary Mobile Contact Number" onkeypress="return isNumberKey(event)"
                                    maxlength="12">
                                @error('primary_mobile_contact_number')
                                    <small id="primary_mobile_contact_number-error"
                                        class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-4">
                                <label for="primary_mobile_network_provider" class="col-form-label">Primary Mobile Network
                                    Provider <span class="text-danger">*</span></label>
                                <select id="primary_mobile_network_provider"
                                    class="form-select @error('primary_mobile_network_provider') is-invalid @enderror"
                                    name="primary_mobile_network_provider">
                                    <option value="">Select Network Provider</option>
                                    <option value="Vodafone"
                                        {{ old('primary_mobile_network_provider', isset($contact_information) ? $contact_information['primary_mobile_network_provider'] : '') == 'Vodafone' ? 'selected' : '' }}>
                                        Vodafone
                                    </option>
                                    <option value="Inkk"
                                        {{ old('primary_mobile_network_provider', isset($contact_information) ? $contact_information['primary_mobile_network_provider'] : '') == 'Inkk' ? 'selected' : '' }}>Inkk
                                    </option>
                                    <option value="Digicel"
                                        {{ old('primary_mobile_network_provider', isset($contact_information) ? $contact_information['primary_mobile_network_provider'] : '') == 'Digicel' ? 'selected' : '' }}>
                                        Digicel
                                    </option>
                                </select>
                                @error('primary_mobile_network_provider')
                                    <small id="primary_mobile_contact_number-error"
                                        class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}
                            <div class="col-lg-12">
                                <label for="other_contact_numbers" class="col-form-label">Other Contact Numbers</label>
                                <input id="other_contact_numbers" type="text"
                                    class="form-control @error('other_contact_numbers') is-invalid @enderror"
                                    name="other_contact_numbers" value="{{ old('other_contact_numbers', isset($contact_information) ? $contact_information['other_contact_numbers'] : '') }}"
                                    autocomplete="other_contact_numbers" placeholder="Landline Contact"
                                    onkeypress="return isNumberKey(event)" maxlength="12">
                                @error('other_contact_numbers')
                                    <small id="other_contact_numbers-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('personal-information.form') }}"
                            class="btn btn-sm btn-warning float-start">Previous
                            Step</a>
                        <button type="submit" form="contactInformationForm"
                            class="btn btn-sm btn-success float-end">Next
                            Step</button>
                    </div>
                </div>               
            </form>
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
