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
                            <li class="breadcrumb-item active">Special Information</li>
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
                            <a class="nav-link active show" href="{{ route('my-profile.special-information.form') }}">
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
                <form action="{{ route('my-profile.special-information') }}" method="POST" id="specialInformationForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Special Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="any_police_records" class="col-form-label">Any Police Records <span
                                            class="text-danger">*</span></label>
                                    <select id="any_police_records"
                                        class="form-select @error('any_police_records') is-invalid @enderror"
                                        name="any_police_records">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('any_police_records', isset($special_information) ? $special_information->any_police_records : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('any_police_records', isset($special_information) ? $special_information->any_police_records : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('any_police_records')
                                        <small id="any_police_records-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="any_special_needs" class="col-form-label">Any Special Needs (e.g. sight
                                        impairment, wheelchair prone)<span class="text-danger">*</span></label>
                                    <select id="any_special_needs"
                                        class="form-select @error('any_special_needs') is-invalid @enderror"
                                        name="any_special_needs">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('any_special_needs', isset($special_information) ? $special_information->any_special_needs : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('any_special_needs', isset($special_information) ? $special_information->any_special_needs : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('any_special_needs')
                                        <small id="any_special_needs-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="specify_special_needs" class="col-form-label">Specify Special Needs (If you
                                        do
                                        provide details)</label>
                                    <input id="specify_special_needs" type="text"
                                        class="form-control @error('specify_special_needs') is-invalid @enderror"
                                        name="specify_special_needs"
                                        value="{{ old('specify_special_needs', isset($special_information) ? $special_information->specify_special_needs : '') }}"
                                        autocomplete="specify_special_needs"
                                        placeholder="Specify Special Needs (If you do provide details)">
                                    @error('specify_special_needs')
                                        <small id="specify_special_needs-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="any_medical_conditions" class="col-form-label">Any Medical Conditions (e.g.
                                        Asthama)<span class="text-danger">*</span></label>
                                    <select id="any_medical_conditions"
                                        class="form-select @error('any_medical_conditions') is-invalid @enderror"
                                        name="any_medical_conditions">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('any_medical_conditions', isset($special_information) ? $special_information->any_medical_conditions : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('any_medical_conditions', isset($special_information) ? $special_information->any_medical_conditions : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('any_medical_conditions')
                                        <small id="any_medical_conditions-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="specify_medical_conditions" class="col-form-label">Specify Medical
                                        Conditions
                                        (If you do provide details)</label>
                                    <input id="specify_medical_conditions" type="text"
                                        class="form-control @error('specify_medical_conditions') is-invalid @enderror"
                                        name="specify_medical_conditions"
                                        value="{{ old('specify_medical_conditions', isset($special_information) ? $special_information->specify_medical_conditions : '') }}"
                                        autocomplete="specify_medical_conditions"
                                        placeholder="Specify Medical Conditions (If you do provide details)">
                                    @error('specify_medical_conditions')
                                        <small id="specify_medical_conditions-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="know_how_to_swim" class="col-form-label">Do you know how to swim ? <span
                                            class="text-danger">*</span></label>
                                    <select id="know_how_to_swim"
                                        class="form-select @error('know_how_to_swim') is-invalid @enderror"
                                        name="know_how_to_swim">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('know_how_to_swim', isset($special_information) ? $special_information->know_how_to_swim : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('know_how_to_swim', isset($special_information) ? $special_information->know_how_to_swim : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('know_how_to_swim')
                                        <small id="know_how_to_swim-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="full_covid_vaccination" class="col-form-label">Full COVID-19 Vaccination
                                        <span class="text-danger">*</span></label>
                                    <select id="full_covid_vaccination"
                                        class="form-select @error('full_covid_vaccination') is-invalid @enderror"
                                        name="full_covid_vaccination">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('full_covid_vaccination', isset($special_information) ? $special_information->full_covid_vaccination : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('full_covid_vaccination', isset($special_information) ? $special_information->full_covid_vaccination : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('full_covid_vaccination')
                                        <small id="full_covid_vaccination-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="date_first_vaccine" class="col-form-label">Date First vaccine </label>
                                    <input id="date_first_vaccine" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" 
                                        class="form-control @error('date_first_vaccine') is-invalid @enderror"
                                        name="date_first_vaccine"
                                        value="{{ old('date_first_vaccine', isset($special_information) ? $special_information->date_first_vaccine : '') }}"
                                        autocomplete="date_first_vaccine" placeholder="Date first vaccine" autofocus>
                                    @error('date_first_vaccine')
                                        <small id="date_first_vaccine-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="date_second_vaccine" class="col-form-label">Date Second vaccine </label>
                                    <input id="date_second_vaccine" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" 
                                        class="form-control @error('date_second_vaccine') is-invalid @enderror"
                                        name="date_second_vaccine"
                                        value="{{ old('date_second_vaccine', isset($special_information) ? $special_information->date_second_vaccine : '') }}"
                                        autocomplete="date_second_vaccine" placeholder="Date second vaccine" autofocus>
                                    @error('date_second_vaccine')
                                        <small id="date_second_vaccine-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="date_booster" class="col-form-label">Date Booster </label>
                                    <input id="date_booster" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" 
                                        class="form-control @error('date_booster') is-invalid @enderror"
                                        name="date_booster"
                                        value="{{ old('date_booster', isset($special_information) ? $special_information->date_booster : '') }}"
                                        autocomplete="date_booster" placeholder="Date Booster" autofocus>
                                    @error('date_booster')
                                        <small id="date_booster-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Blood Information </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label for="blood_donar" class="col-form-label">Blood Donar<span
                                            class="text-danger">*</span></label>
                                    <select id="blood_donar"
                                        class="form-select @error('blood_donar') is-invalid @enderror"
                                        name="blood_donar">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('blood_donar', isset($blood_information) ? $blood_information->blood_donar : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('blood_donar', isset($blood_information) ? $blood_information->blood_donar : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('blood_donar')
                                        <small id="blood_donar-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="know_your_blood_group" class="col-form-label">Do you know your Blood Group
                                        ?<span class="text-danger">*</span></label>
                                    <select id="know_your_blood_group"
                                        class="form-select @error('know_your_blood_group') is-invalid @enderror"
                                        name="know_your_blood_group">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('know_your_blood_group', isset($blood_information) ? $blood_information->know_your_blood_group : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('know_your_blood_group', isset($blood_information) ? $blood_information->know_your_blood_group : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('know_your_blood_group')
                                        <small id="know_your_blood_group-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="blood_group" class="col-form-label">Blood Group</span></label>
                                    <select id="blood_group"
                                        class="form-select @error('blood_group') is-invalid @enderror"
                                        name="blood_group">
                                        <option value="">Select</option>
                                        <option value="A+"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'A+' ? 'selected' : '' }}>
                                            A+
                                        </option>
                                        <option value="A-"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'A-' ? 'selected' : '' }}>
                                            A-
                                        </option>
                                        <option value="B+"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'B+' ? 'selected' : '' }}>
                                            B+
                                        </option>
                                        <option value="B-"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'B-' ? 'selected' : '' }}>
                                            B-
                                        </option>
                                        <option value="O+"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'O+' ? 'selected' : '' }}>
                                            O+
                                        </option>
                                        <option value="O-"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'O-' ? 'selected' : '' }}>
                                            O-
                                        </option>
                                        <option value="AB+"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'AB+' ? 'selected' : '' }}>
                                            AB+
                                        </option>
                                        <option value="AB-"
                                            {{ old('blood_group', isset($blood_information) ? $blood_information->blood_group : '') == 'AB-' ? 'selected' : '' }}>
                                            AB-
                                        </option>

                                    </select>
                                    @error('blood_group')
                                        <small id="blood_group_name-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Volunteering Information </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="col-form-label">List any Volunteer Experience and If you were involved
                                        with Red Cross</label>
                                </div>
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-sm table-bordered" id="volunteers">
                                        <thead>
                                            <tr>
                                                <th>Year</th>
                                                <th>Experience</th>
                                                <th>Red Cross Involvement</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($volunteers) > 0)
                                                @foreach ($volunteers as $key => $volunteer)
                                                    <tr id="volunteer-row{{ $key }}">
                                                        <td><input type="text" class="form-control form-control-sm"
                                                                name="volunteer[{{ $key }}][year]"
                                                                onkeypress="return isNumberKey(event)" maxlength="4"
                                                                value="{{ $volunteer->year }}" required></td>
                                                        <td><input type="text" class="form-control form-control-sm"
                                                                name="volunteer[{{ $key }}][experience]"
                                                                value="{{ $volunteer->experience }}" required></td>
                                                        <td><select class="form-select form-control-sm"
                                                                name="volunteer[{{ $key }}][red_cross_involvement]"
                                                                required>
                                                                <option value="">Select</option>
                                                                <option value="Yes"
                                                                    {{ $volunteer->red_cross_involvement == 'Yes' ? 'selected' : '' }}>
                                                                    Yes</option>
                                                                <option value="No"
                                                                    {{ $volunteer->red_cross_involvement == 'No' ? 'selected' : '' }}>
                                                                    No</option>
                                                            </select></td>
                                                        <td class="text-end"><button class="btn btn-sm btn-danger"
                                                                onclick="$('#volunteer-row{{ $key }}').remove();"><i
                                                                    class="mdi mdi-delete"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr id="volunteer-row0">
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="volunteer[0][year]"
                                                            onkeypress="return isNumberKey(event)" maxlength="4"
                                                            required></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="volunteer[0][experience]" required></td>
                                                    <td><select class="form-select form-control-sm"
                                                            name="volunteer[0][red_cross_involvement]" required>
                                                            <option value="">Select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select></td>
                                                    <td class="text-end"><button class="btn btn-sm btn-danger"
                                                            onclick="$('#volunteer-row0').remove();"><i
                                                                class="mdi mdi-delete"></i></button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-end">
                                                    <button type="button" class="btn btn-sm btn-info"
                                                        onclick="addVolunteership();"><i
                                                            class="mdi mdi-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" form="specialInformationForm"
                                class="btn btn-sm btn-success float-end">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        @if (count($volunteers) > 0)
            var volunteer_row = {{ count($volunteers) }};
        @else
            var volunteer_row = 1;
        @endif
        function addVolunteership() {
            html = '<tr id="volunteer-row' + volunteer_row + '">';
            html += '<td><input type="text" class="form-control form-control-sm" name="volunteer[' + volunteer_row +
                '][year]" onkeypress="return isNumberKey(event)" maxlength="4" required></td>';
            html += '<td><input type="text" class="form-control form-control-sm" name="volunteer[' + volunteer_row +
                '][experience]" required></td>';
            html += '<td><select class="form-select form-control-sm" name="volunteer[' + volunteer_row +
                '][red_cross_involvement]" required><option value="">Select</option><option value="Yes">Yes</option><option value="No">No</option></select></td>';
            html += '<td class="text-end"><button class="btn btn-sm btn-danger" onclick="$(\'#volunteer-row' +
                volunteer_row + '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
            html += '</tr>';

            $('#volunteers tbody').append(html);

            volunteer_row++;
        }
    </script>
@endpush
