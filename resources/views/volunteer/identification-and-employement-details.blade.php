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
            <form action="{{ route('identification-and-employement-details') }}" method="POST" id="identificationAndEmployementDetailsForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Valid National Identification</h4>
                        <p class="text-center text-muted">Step 5</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">                           
                            <div class="col-lg-6">
                                <label for="photo_id_card_type" class="col-form-label">Photo ID Card Type <span
                                        class="text-danger">*</span></label>
                                <select id="photo_id_card_type"
                                    class="form-select @error('photo_id_card_type') is-invalid @enderror" name="photo_id_card_type">
                                    <option value="">Select Photo ID Card Type</option>
                                    <option value="Drivers License" {{ old('photo_id_card_type') == 'Drivers License' ? 'selected' : '' }}>
                                        Drivers License
                                    </option>
                                    <option value="Passport"
                                        {{ old('photo_id_card_type') == 'Passport' ? 'selected' : '' }}>Passport
                                    </option>
                                    <option value="FNPF-TIN Joint Card" {{ old('photo_id_card_type') == 'FNPF-TIN Joint Card' ? 'selected' : '' }}>
                                        FNPF-TIN Joint Card
                                    </option>
                                    <option value="Student ID" {{ old('photo_id_card_type') == 'Student ID' ? 'selected' : '' }}>Student ID
                                    </option>
                                    <option value="Voter ID" {{ old('photo_id_card_type') == 'Voter ID' ? 'selected' : '' }}>Voter ID
                                    </option>
                                    <option value="Other"
                                        {{ old('photo_id_card_type') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('photo_id_card_type')
                                    <small id="photo_id_card_type-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="specify_photo_id_card_type" class="col-form-label">Specify Photo ID Card (If any
                                    other)</label>
                                <input id="specify_photo_id_card_type" type="text"
                                    class="form-control @error('specify_photo_id_card_type') is-invalid @enderror"
                                    name="specify_photo_id_card_type" value="{{ old('specify_photo_id_card_type') }}"
                                    autocomplete="specify_photo_id_card_type" placeholder="Specify Photo ID Card (If any other)">
                                @error('specify_photo_id_card_type')
                                    <small id="specify_photo_id_card_type-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="id_card_number" class="col-form-label">ID Card Number<span
                                        class="text-danger">*</span></label>
                                <input id="id_card_number" type="text"
                                    class="form-control @error('id_card_number') is-invalid @enderror" name="id_card_number"
                                    value="{{ old('id_card_number') }}" autocomplete="id_card_number" placeholder="ID Card Number">
                                @error('id_card_number')
                                    <small id="id_card_number-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="id_expiry_date" class="col-form-label">ID Expiry Date<span
                                        class="text-danger">*</span></label>
                                <input id="id_expiry_date" type="date"
                                    class="form-control @error('id_expiry_date') is-invalid @enderror" name="id_expiry_date"
                                    value="{{ old('id_expiry_date') }}" autocomplete="id_expiry_date" placeholder="ID Card Number">
                                @error('id_expiry_date')
                                    <small id="id_expiry_date-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="tin" class="col-form-label">TIN<span
                                        class="text-danger">*</span></label>
                                <input id="tin" type="text"
                                    class="form-control @error('tin') is-invalid @enderror" name="tin"
                                    value="{{ old('tin') }}" autocomplete="tin" placeholder="TIN">
                                @error('tin')
                                    <small id="tin-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="photo_id" class="col-form-label">Upload Photo ID</label>
                                <input id="photo_id" type="file"
                                    class="form-control @error('photo_id') is-invalid @enderror" name="photo_id">
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
                        <p class="text-center text-muted">Step 6</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-lg-12">
                                <label for="current_employment_status" class="col-form-label">Current Employment Status <span
                                        class="text-danger">*</span></label>
                                <select id="current_employment_status"
                                    class="form-select @error('current_employment_status') is-invalid @enderror" name="current_employment_status">
                                    <option value="">Select Current Employment Status</option>
                                    <option value="Employed" {{ old('current_employment_status') == 'Employed' ? 'selected' : '' }}>
                                        Employed
                                    </option>
                                    <option value="Not-Employed"
                                        {{ old('current_employment_status') == 'Not-Employed' ? 'selected' : '' }}>Not-Employed
                                    </option>
                                    <option value="Student" {{ old('current_employment_status') == 'Student' ? 'selected' : '' }}>
                                        Student
                                    </option>
                                    <option value="Retired / Pensioner" {{ old('current_employment_status') == 'Retired / Pensioner' ? 'selected' : '' }}>Retired / Pensioner
                                    </option>
                                    <option value="Self-Employed" {{ old('current_employment_status') == 'Self-Employed' ? 'selected' : '' }}>Self-Employed
                                    </option>                                    
                                </select>
                                @error('current_employment_status')
                                    <small id="current_employment_status-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>                            
                            <div class="col-lg-6">
                                <label for="current_occupation" class="col-form-label">Current Occupation <span>(If Employed / Self Employed)</span></label>
                                <input id="current_occupation" type="text"
                                    class="form-control @error('current_occupation') is-invalid @enderror"
                                    name="current_occupation" value="{{ old('current_occupation') }}"
                                    autocomplete="current_occupation" placeholder="Current Occupation">
                                @error('current_occupation')
                                    <small id="current_occupation-error"
                                        class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="organisation_name" class="col-form-label">Organisation Name <span>(If Employed / Self Employed)</span></label>
                                <input id="organisation_name" type="text"
                                    class="form-control @error('organisation_name') is-invalid @enderror"
                                    name="organisation_name" value="{{ old('organisation_name') }}"
                                    autocomplete="organisation_name" placeholder="Organisation Name">
                                @error('organisation_name')
                                    <small id="organisation_name-error"
                                        class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="organisation_address" class="col-form-label">Organisation Address <span>(If Employed / Self Employed)</span></label>
                                <input id="organisation_address" type="text"
                                    class="form-control @error('organisation_address') is-invalid @enderror"
                                    name="organisation_address" value="{{ old('organisation_address') }}"
                                    autocomplete="organisation_address" placeholder="Organisation Address">
                                @error('organisation_address')
                                    <small id="organisation_address-error"
                                        class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="work_contact_number" class="col-form-label">Work Contact Number <span>(If Employed / Self Employed)</span></label>
                                <input id="work_contact_number" type="text"
                                    class="form-control @error('work_contact_number') is-invalid @enderror"
                                    name="work_contact_number" value="{{ old('work_contact_number') }}"
                                    autocomplete="work_contact_number" placeholder="Work Contact Number">
                                @error('work_contact_number')
                                    <small id="work_contact_number-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('contact-information.form') }}"
                            class="btn btn-sm btn-warning float-start">Previous
                            Step</a>
                        <button type="submit" form="identificationAndEmployementDetailsForm"
                            class="btn btn-sm btn-success float-end">Next
                            Step</button>
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
