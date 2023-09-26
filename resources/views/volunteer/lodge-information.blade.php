@php
$lodgement_information = Session::get('lodgement-information');
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
    <div class="container pt-3 text-center1">
        <p class="text-center"><b>Join the Fiji Red Cross Society and make a difference in your community!</b></p>
        <p>The Fiji Red Cross Society is a humanitarian organization that provides assistance to people in need, both in Fiji and around the world. We rely on our volunteers to carry out our work, and we are always looking for new people to join our team.
            Whether you have skills and experience in first aid, disaster response, or community development, there is a place for you at the Fiji Red Cross Society. We also need volunteers to help with administrative tasks, fundraising, and public relations.</p>

        <p><b>Here are just a few of the ways you can make a difference as a Fiji Red Cross Society volunteer:</b></p>
        <p>• Respond to disasters and emergencies</p>
        <p>• Provide first aid assistance</p>
        <p>• Teach first aid and other life-saving skills</p>
        <p>• Promote disaster risk reduction and preparedness</p>
        <p>• Support vulnerable communities</p>
        <p>• Help to build a more resilient Fiji</p>
        <p>Volunteering with the Fiji Red Cross Society is a rewarding experience that will allow you to make a real difference in the lives of others. You will also have the opportunity to learn new skills, meet new people, and travel to new places.</p>
        <p>So, what are you waiting for? Register to become a Fiji Red Cross Society volunteer today!</p>
        <p class="text-center"><b>Together, we can make a difference!</b></p>
    </div>
</section>

<hr>
<section>
    <div class="container pt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title text-center fw-bold">Lodgement Information</h4>
                <p class="text-center text-muted">Step 1</p>
            </div>
            <div class="card-body">
                <form action="{{ route('lodge-information') }}" method="POST" id="lodgeInformationForm">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="date_of_lodgement" class="col-form-label">Date of Lodgement <span class="text-danger">*</span></label>
                            <input id="date_of_lodgement" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control @error('date_of_lodgement') is-invalid @enderror" name="date_of_lodgement" value="{{ old('date_of_lodgement', isset($lodgement_information) ? $lodgement_information['date_of_lodgement'] : \Carbon\Carbon::now()->format('Y-m-d')) }}" autocomplete="date_of_lodgement" placeholder="Date of Lodgement" autofocus>
                            @error('date_of_lodgement')
                            <small id="date_of_lodgement-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="registering_year" class="col-form-label">Registering Year <span class="text-danger">*</span></label>
                            <input id="registering_year" type="text" class="form-control @error('registering_year') is-invalid @enderror" name="registering_year" value="{{ old('registering_year', isset($lodgement_information) ? $lodgement_information['registering_year'] : \Carbon\Carbon::now()->format('Y')) }}" autocomplete="registering_year" placeholder="Registering Year" onkeypress="return isNumberKey(event)" maxlength="4">
                            @error('registering_year')
                            <small id="registering_year-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="division" class="col-form-label">Division <span class="text-danger">*</span></label>
                            <select id="division" class="form-select @error('division') is-invalid @enderror" name="division">
                                <option value="">Select Division</option>
                                <option value="Central / Eastern" {{ old('division', isset($lodgement_information) ? $lodgement_information['division'] : '') == 'Central / Eastern' ? 'selected' : '' }}>
                                    Central / Eastern
                                </option>
                                <option value="Western" {{ old('division', isset($lodgement_information) ? $lodgement_information['division'] : '') == 'Western' ? 'selected' : '' }}>
                                    Western
                                </option>
                                <option value="Northern" {{ old('division', isset($lodgement_information) ? $lodgement_information['division'] : '') == 'Northern' ? 'selected' : '' }}>
                                    Northern
                                </option>
                            </select>
                            @error('division')
                            <small id="division-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="registration_location_type" class="col-form-label">Your Nearest Branch <span class="text-danger">*</span></label>
                            <select id="registration_location_type" class="form-select @error('registration_location_type') is-invalid @enderror" name="registration_location_type">
                                <option value="">Branch</option>
                                <optgroup label="Central / Eastern">
                                    <option value="Rotuma" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Rotuma' ? 'selected' : '' }}>
                                        Rotuma
                                    </option>
                                    <option value="Levuka" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Levuka' ? 'selected' : '' }}>
                                        Levuka
                                    </option>
                                    <option value="Suva" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Suva' ? 'selected' : '' }}>
                                        Suva
                                    </option>
                                </optgroup>
                                <optgroup label="Western">
                                    <option value="Sigatoka" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Sigatoka' ? 'selected' : '' }}>
                                        Sigatoka
                                    </option>
                                    <option value="Nadi" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Nadi' ? 'selected' : '' }}>
                                        Nadi
                                    </option>
                                    <option value="Lautoka" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Lautoka' ? 'selected' : '' }}>
                                        Lautoka
                                    </option>
                                    <option value="Ba" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Ba' ? 'selected' : '' }}>
                                        Ba
                                    </option>
                                    <option value="Tavua" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Tavua' ? 'selected' : '' }}>
                                        Tavua
                                    </option>
                                    <option value="Rakiraki" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Rakiraki' ? 'selected' : '' }}>
                                        Rakiraki
                                    </option>
                                    <option value="Nalawa" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Nalawa' ? 'selected' : '' }}>
                                        Nalawa
                                    </option>
                                </optgroup>
                                <optgroup label="Northern">
                                    <option value="Bua" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Bua' ? 'selected' : '' }}>
                                        Bua
                                    </option>
                                    <option value="Seaqaqa" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Seaqaqa' ? 'selected' : '' }}>
                                        Seaqaqa
                                    </option>
                                    <option value="Savusavu" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Savusavu' ? 'selected' : '' }}>
                                        Savusavu
                                    </option>
                                    <option value="Labasa" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Labasa' ? 'selected' : '' }}>
                                        Labasa
                                    </option>
                                    <option value="Taveuni" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Taveuni' ? 'selected' : '' }}>
                                        Taveuni
                                    </option>
                                    <option value="Rabi" {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Rabi' ? 'selected' : '' }}>
                                        Rabi
                                    </option>
                                </optgroup>
                            </select>
                            @error('registration_location_type')
                            <small id="registration_location_type-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="role" class="col-form-label">Role <span class="text-danger">*</span></label>
                            <select id="role" class="form-select @error('role') is-invalid @enderror" name="role">
                                <option value="">Select role</option>
                                <option value="volunteer" {{ old('role', isset($lodgement_information) ? $lodgement_information['role'] : '') == 'volunteer' ? 'selected' : '' }}>
                                    Volunteer
                                </option>
                                <option value="member" {{ old('role', isset($lodgement_information) ? $lodgement_information['role'] : '') == 'member' ? 'selected' : '' }}>
                                    Member
                                </option>
                                <option value="both" {{ old('role', isset($lodgement_information) ? $lodgement_information['role'] : '') == 'both' ? 'selected' : '' }}>
                                    Both
                                </option>
                            </select>
                            @error('role')
                            <small id="role-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="submit" form="lodgeInformationForm" class="btn btn-sm btn-success float-end">Next
                    Step</button>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container pt-1 pb-3">
        <i>* Please note that all the information bothered here is treated as "Confidential". Information will only be
            used for the management of members and volunteers and access Is limited to <strong> authorised persons
                only.</strong></i>
    </div>
</section>
@endsection