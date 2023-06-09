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
                                <label for="date_of_lodgement" class="col-form-label">Date of Lodgement <span
                                        class="text-danger">*</span></label>
                                <input id="date_of_lodgement" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" 
                                    class="form-control @error('date_of_lodgement') is-invalid @enderror"
                                    name="date_of_lodgement" value="{{ old('date_of_lodgement', isset($lodgement_information) ? $lodgement_information['date_of_lodgement'] : '') }}"
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
                                    name="registering_year" value="{{ old('registering_year', isset($lodgement_information) ? $lodgement_information['registering_year'] : '') }}"
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
                                        {{ old('division', isset($lodgement_information) ? $lodgement_information['division'] : '') == 'Central / Eastern' ? 'selected' : '' }}>Central / Eastern
                                    </option>
                                    <option value="Western" {{ old('division', isset($lodgement_information) ? $lodgement_information['division'] : '') == 'Western' ? 'selected' : '' }}>Western
                                    </option>
                                    <option value="Northern" {{ old('division', isset($lodgement_information) ? $lodgement_information['division'] : '') == 'Northern' ? 'selected' : '' }}>Northern
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
                                    <div class="col-md-8">
                                        <input id="registration_location" type="text"
                                            class="form-control @error('registration_location') is-invalid @enderror"
                                            name="registration_location" value="{{ old('registration_location', isset($lodgement_information) ? $lodgement_information['registration_location'] : '') }}"
                                            autocomplete="registration_location"
                                            placeholder="Branch/Office Location E.g. Suva, Tuvaua etc." autofocus>
                                        @error('registration_location')
                                            <small id="registration_location-error"
                                                class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <select id="registration_location_type"
                                            class="form-select @error('registration_location_type') is-invalid @enderror"
                                            name="registration_location_type">
                                            <option value="Branch"
                                                {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'Branch' ? 'selected' : '' }}>
                                                Branch
                                            </option>
                                            <option value="National Office"
                                                {{ old('registration_location_type', isset($lodgement_information) ? $lodgement_information['registration_location_type'] : '') == 'National Office' ? 'selected' : '' }}>
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
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="lodgeInformationForm" class="btn btn-sm btn-success float-end">Next Step</button>
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
