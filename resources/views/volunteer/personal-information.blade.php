@php
    $personal_information = Session::get('personal-information');
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
                    <h4 class="header-title text-center fw-bold">Personal Information</h4>
                    <p class="text-center text-muted">Step 2</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('personal-information') }}" method="POST" id="personalInformationForm">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <small><i>* Please state name as per birth certificate</i></small>
                            </div>
                            <div class="col-lg-4">
                                <label for="lastname" class="col-form-label">Lastname <span
                                        class="text-danger">*</span></label>
                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                    value="{{ old('lastname', isset($personal_information) ? $personal_information['lastname'] : '') }}" autocomplete="lastname" placeholder="Lastname" autofocus>
                                @error('lastname')
                                    <small id="lastname-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="firstname" class="col-form-label">Firstname <span
                                        class="text-danger">*</span></label>
                                <input id="firstname" type="text"
                                    class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                    value="{{ old('firstname', isset($personal_information) ? $personal_information['firstname'] : '') }}" autocomplete="firstname" placeholder="Firstname">
                                @error('firstname')
                                    <small id="firstname-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="other_names" class="col-form-label">Other Name(s)</label>
                                <input id="other_names" type="text"
                                    class="form-control @error('other_names') is-invalid @enderror" name="other_names"
                                    value="{{ old('other_names', isset($personal_information) ? $personal_information['other_names'] : '') }}" autocomplete="other_names" placeholder="Other Name(s)">
                                @error('other_names')
                                    <small id="registering_year-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="father_name" class="col-form-label">Father's Name <span
                                        class="text-danger">*</span></label>
                                <input id="father_name" type="text"
                                    class="form-control @error('father_name') is-invalid @enderror" name="father_name"
                                    value="{{ old('father_name', isset($personal_information) ? $personal_information['father_name'] : '') }}" autocomplete="father_name" placeholder="Father's Name">
                                @error('father_name')
                                    <small id="father_name-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="date_of_birth" class="col-form-label">Date of Birth <span
                                        class="text-danger">*</span></label>
                                <input id="date_of_birth" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" 
                                    class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                    value="{{ old('date_of_birth', isset($personal_information) ? $personal_information['date_of_birth'] : '') }}" autocomplete="date_of_birth"
                                    placeholder="Date of Birth">
                                @error('date_of_birth')
                                    <small id="date_of_birth-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="sex" class="col-form-label">Sex <span
                                        class="text-danger">*</span></label>
                                <select id="sex" class="form-select @error('sex') is-invalid @enderror"
                                    name="sex">
                                    <option value="">Select sex</option>
                                    <option value="Male" {{ old('sex', isset($personal_information) ? $personal_information['sex'] : '') == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ old('sex', isset($personal_information) ? $personal_information['sex'] : '') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="Non-binary" {{ old('sex', isset($personal_information) ? $personal_information['sex'] : '') == 'Non-binary' ? 'selected' : '' }}>
                                        Non-binary
                                    </option>
                                </select>
                                @error('sex')
                                    <small id="sex-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="citizenship" class="col-form-label">Citizenship <span
                                        class="text-danger">*</span></label>
                                <select id="citizenship" class="form-select @error('citizenship') is-invalid @enderror"
                                    name="citizenship">
                                    <option value="">Select Citizenship</option>
                                    <option value="Fiji" {{ old('citizenship', isset($personal_information) ? $personal_information['citizenship'] : '') == 'Fiji' ? 'selected' : '' }}>Fiji
                                    </option>
                                    <option value="Other" {{ old('citizenship', isset($personal_information) ? $personal_information['citizenship'] : '') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('citizenship')
                                    <small id="citizenship-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="specify_citizenship" class="col-form-label">Specify Citizenship (If any
                                    other)</label>
                                <input id="specify_citizenship" type="text"
                                    class="form-control @error('specify_citizenship') is-invalid @enderror"
                                    name="specify_citizenship" value="{{ old('specify_citizenship', isset($personal_information) ? $personal_information['specify_citizenship'] : '') }}"
                                    autocomplete="specify_citizenship" placeholder="Specify Citizenship">
                                @error('specify_citizenship')
                                    <small id="specify_citizenship-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                           
                            <div class="col-lg-6">
                                <label for="ethnic_background" class="col-form-label">Ethnic Background <span
                                        class="text-danger">*</span></label>
                                <select id="ethnic_background"
                                    class="form-select select2 @error('ethnic_background') is-invalid @enderror"
                                    name="ethnic_background[]"  data-toggle="select2" data-placeholder="Select Ethnic Background" multiple>
                                    <option value="">Select Ethnic Background(s)</option>
                                    <option value="Itaukei"  {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Itaukei") ? 'selected' : '' }}>
                                        Itaukei
                                    </option>
                                    <option value="Indo Fijian"
                                    {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Indo Fijian") ? 'selected' : '' }}>Indo Fijian
                                    </option>
                                    <option value="Chino Fijian"
                                    {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Chino Fijian") ? 'selected' : '' }}>Chino Fijian
                                    </option>
                                    <option value="Chinese"  {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Chinese") ? 'selected' : '' }}>
                                        Chinese
                                    </option>
                                    <option value="Rotuman"  {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Rotuman") ? 'selected' : '' }}>
                                        Rotuman
                                    </option>
                                    <option value="Part-European"
                                    {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Part-European") ? 'selected' : '' }}>Part-European
                                    </option>
                                    <option value="Banaban"  {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Banaban") ? 'selected' : '' }}>
                                        Banaban
                                    </option>
                                    <option value="Kioa Islander"
                                    {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Kioa Islander") ? 'selected' : '' }}>Kioa Islander
                                    </option>
                                    <option value="Other"  {{ collect(old('ethnic_background', isset($personal_information) ? $personal_information['ethnic_background'] : ''))->contains("Other") ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                                @error('ethnic_background')
                                    <small id="ethnic_background-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="specify_ethnic_background" class="col-form-label">Specify Ethnic Background (If any
                                    other)</label>
                                <input id="specify_ethnic_background" type="text"
                                    class="form-control @error('specify_ethnic_background') is-invalid @enderror"
                                    name="specify_ethnic_background" value="{{ old('specify_ethnic_background', isset($personal_information) ? $personal_information['specify_ethnic_background'] : '') }}"
                                    autocomplete="specify_ethnic_background" placeholder="Specify Ethnic Background (If any other)">
                                @error('specify_ethnic_background')
                                    <small id="specify_ethnic_background-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="marital_status" class="col-form-label">Marital Status <span
                                        class="text-danger">*</span></label>
                                <select id="marital_status" class="form-select @error('marital_status') is-invalid @enderror"
                                    name="marital_status">
                                    <option value="">Select Marital Status</option>
                                    <option value="Married" {{ old('marital_status', isset($personal_information) ? $personal_information['marital_status'] : '') == 'Married' ? 'selected' : '' }}>Married
                                    </option>
                                    <option value="Single / Never Married" {{ old('marital_status', isset($personal_information) ? $personal_information['marital_status'] : '') == 'Single / Never Married' ? 'selected' : '' }}>Single / Never Married
                                    </option>
                                    <option value="Divorced" {{ old('marital_status', isset($personal_information) ? $personal_information['marital_status'] : '') == 'Divorced' ? 'selected' : '' }}>Divorced
                                    </option>
                                    <option value="Partner / Defacto" {{ old('marital_status', isset($personal_information) ? $personal_information['marital_status'] : '') == 'Partner / Defacto' ? 'selected' : '' }}>Partner / Defacto
                                    </option>

                                    <option value="Widowed" {{ old('marital_status', isset($personal_information) ? $personal_information['marital_status'] : '') == 'Widowed' ? 'selected' : '' }}>Widowed
                                    </option>
                                    <option value="Prefer not to say" {{ old('marital_status', isset($personal_information) ? $personal_information['marital_status'] : '') == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say
                                    </option>
                                </select>
                                @error('marital_status')
                                    <small id="citizenship-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="no_of_dependents" class="col-form-label">Number of Dependents (person who relies on you e.g. children)<span
                                        class="text-danger">*</span></label>
                                <input id="no_of_dependents" type="number" min="0"
                                    class="form-control @error('no_of_dependents') is-invalid @enderror" name="no_of_dependents"
                                    value="{{ old('no_of_dependents', isset($personal_information) ? $personal_information['no_of_dependents'] : '') }}" autocomplete="no_of_dependents" placeholder="Number of Dependents">
                                @error('no_of_dependents')
                                    <small id="registering_year-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="languages_spoken" class="col-form-label">Language(s) Spoken <span
                                        class="text-danger">*</span></label>
                                <select id="languages_spoken"
                                    class="form-select select2 @error('languages_spoken') is-invalid @enderror"
                                    name="languages_spoken[]"  data-toggle="select2" data-placeholder="Select Language(s) Spoken" multiple>
                                    <option value="">Select Language(s) Spoken</option>
                                    <option value="English"
                                    {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("English") ? 'selected' : '' }}>English
                                </option>
                                    <option value="Itaukei" {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("English") ? 'selected' : '' }}>
                                        Itaukei
                                    </option>
                                   
                                    <option value="Hindi"
                                    {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("English") ? 'selected' : '' }}>Hindi
                                    </option>                                   
                                    <option value="Rotuman" {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("Hindi") ? 'selected' : '' }}>
                                        Rotuman
                                    </option>
                                    <option value="Urdu"
                                    {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("English") ? 'selected' : '' }}>Urdu
                                    </option>
                                    <option value="Banaban" {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("Urdu") ? 'selected' : '' }}>
                                        Banaban
                                    </option>                                   
                                    <option value="Other Languages"  {{ collect(old('languages_spoken', isset($personal_information) ? $personal_information['languages_spoken'] : ''))->contains("Other Languages") ? 'selected' : '' }}>
                                        Other Languages
                                    </option>
                                </select>
                                @error('languages_spoken')
                                    <small id="languages_spoken-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="specify_languages_spoken" class="col-form-label">Specify Languages Spoken (If any
                                    other)</label>
                                <input id="specify_languages_spoken" type="text"
                                    class="form-control @error('specify_languages_spoken') is-invalid @enderror"
                                    name="specify_languages_spoken" value="{{ old('specify_languages_spoken', isset($personal_information) ? $personal_information['specify_languages_spoken'] : '') }}"
                                    autocomplete="specify_languages_spoken" placeholder="Specify Language(s) Spoken (If any other)">
                                @error('specify_languages_spoken')
                                    <small id="specify_languages_spoken-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('lodge-information.form') }}" class="btn btn-sm btn-warning float-start">Previous
                        Step</a>
                    <button type="submit" form="personalInformationForm" class="btn btn-sm btn-success float-end">Next
                        Step</button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-1 pb-3">
            <ul>
                <li>
                    Please note that all the information bothered here is treated as "Confidential". Information will only be
                    used for the management of members and volunteers and access Is limited to <strong> authorised persons
                        only.</strong>
                </li>
                <li>Volunteers will have to re-register if inactive for more than 2 years</li>
            </ul>           
        </div>
    </section>
@endsection
