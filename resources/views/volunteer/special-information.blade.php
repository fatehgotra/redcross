@php
    $special_information = Session::get('special-information');
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
            <form action="{{ route('special-information') }}" method="POST"
                id="specialInformationForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Special Information</h4>
                        <p class="text-center text-muted">Step 8</p>
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
                                    <option value="Yes" {{ old('any_police_records', isset($special_information) ? $special_information['any_police_records'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('any_police_records', isset($special_information) ? $special_information['any_police_records'] : '') == 'No' ? 'selected' : '' }}>No
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
                                    <option value="Yes" {{ old('any_special_needs', isset($special_information) ? $special_information['any_special_needs'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('any_special_needs', isset($special_information) ? $special_information['any_special_needs'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('any_special_needs')
                                    <small id="any_special_needs-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="specify_special_needs" class="col-form-label">Specify Special Needs (If you do
                                    provide details)</label>
                                <input id="specify_special_needs" type="text"
                                    class="form-control @error('specify_special_needs') is-invalid @enderror"
                                    name="specify_special_needs" value="{{ old('specify_special_needs' , isset($special_information) ? $special_information['specify_special_needs'] : '') }}"
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
                                    <option value="Yes" {{ old('any_medical_conditions', isset($special_information) ? $special_information['any_medical_conditions'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('any_medical_conditions', isset($special_information) ? $special_information['any_medical_conditions'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('any_medical_conditions')
                                    <small id="any_medical_conditions-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="specify_medical_conditions" class="col-form-label">Specify Medical Conditions
                                    (If you do provide details)</label>
                                <input id="specify_medical_conditions" type="text"
                                    class="form-control @error('specify_medical_conditions') is-invalid @enderror"
                                    name="specify_medical_conditions" value="{{ old('specify_medical_conditions', isset($special_information) ? $special_information['specify_medical_conditions'] : '') }}"
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
                                    <option value="Yes" {{ old('know_how_to_swim', isset($special_information) ? $special_information['know_how_to_swim'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('know_how_to_swim', isset($special_information) ? $special_information['know_how_to_swim'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('know_how_to_swim')
                                    <small id="know_how_to_swim-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="full_covid_vaccination" class="col-form-label">Full COVID-19 Vaccination <span
                                        class="text-danger">*</span></label>
                                <select id="full_covid_vaccination"
                                    class="form-select @error('full_covid_vaccination') is-invalid @enderror"
                                    name="full_covid_vaccination">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('full_covid_vaccination', isset($special_information) ? $special_information['full_covid_vaccination'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('full_covid_vaccination', isset($special_information) ? $special_information['full_covid_vaccination'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('full_covid_vaccination')
                                    <small id="full_covid_vaccination-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="date_first_vaccine" class="col-form-label">Date First vaccine </label>
                                <input id="date_first_vaccine" type="date"
                                    class="form-control @error('date_first_vaccine') is-invalid @enderror"
                                    name="date_first_vaccine" value="{{ old('date_first_vaccine', isset($special_information) ? $special_information['date_first_vaccine'] : '') }}"
                                    autocomplete="date_first_vaccine" placeholder="Date first vaccine" autofocus>
                                @error('date_first_vaccine')
                                    <small id="date_first_vaccine-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="date_second_vaccine" class="col-form-label">Date Second vaccine </label>
                                <input id="date_second_vaccine" type="date"
                                    class="form-control @error('date_second_vaccine') is-invalid @enderror"
                                    name="date_second_vaccine" value="{{ old('date_second_vaccine', isset($special_information) ? $special_information['date_second_vaccine'] : '') }}"
                                    autocomplete="date_second_vaccine" placeholder="Date second vaccine" autofocus>
                                @error('date_second_vaccine')
                                    <small id="date_second_vaccine-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="date_booster" class="col-form-label">Date Booster </label>
                                <input id="date_booster" type="date"
                                    class="form-control @error('date_booster') is-invalid @enderror" name="date_booster"
                                    value="{{ old('date_booster', isset($special_information) ? $special_information['date_booster'] : '') }}" autocomplete="date_booster"
                                    placeholder="Date Booster" autofocus>
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
                        <p class="text-center text-muted">Step 9</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-lg-6">
                                <label for="blood_donar" class="col-form-label">Blood Donar<span
                                        class="text-danger">*</span></label>
                                <select id="blood_donar" class="form-select @error('blood_donar') is-invalid @enderror"
                                    name="blood_donar">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('blood_donar', isset($special_information) ? $special_information['blood_donar'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('blood_donar', isset($special_information) ? $special_information['blood_donar'] : '') == 'No' ? 'selected' : '' }}>No
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
                                    <option value="Yes" {{ old('know_your_blood_group', isset($special_information) ? $special_information['know_your_blood_group'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('know_your_blood_group', isset($special_information) ? $special_information['know_your_blood_group'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('know_your_blood_group')
                                    <small id="know_your_blood_group-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="blood_group" class="col-form-label">Blood Group</span></label>
                                <select id="blood_group" class="form-select @error('blood_group') is-invalid @enderror"
                                    name="blood_group">
                                    <option value="">Select</option>
                                    <option value="A+" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'A+' ? 'selected' : '' }}>
                                        A+
                                    </option>
                                    <option value="A-" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'A-' ? 'selected' : '' }}>A-
                                    </option>
                                    <option value="B+" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'B+' ? 'selected' : '' }}>B+
                                    </option>
                                    <option value="B-" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'B-' ? 'selected' : '' }}>B-
                                    </option>
                                    <option value="O+" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'O+' ? 'selected' : '' }}>O+
                                    </option>
                                    <option value="O-" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'O-' ? 'selected' : '' }}>O-
                                    </option>
                                    <option value="AB+" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'AB+' ? 'selected' : '' }}>AB+
                                    </option>
                                    <option value="AB-" {{ old('blood_group', isset($special_information) ? $special_information['blood_group'] : '') == 'AB-' ? 'selected' : '' }}>AB-
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
                        <p class="text-center text-muted">Step 10</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-form-label">List any Volunteer Experience and If you were involved with Red Cross</label>
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
                                        @isset($special_information)
                                            @if(count($special_information['volunteers']) > 0)
                                            @foreach($special_information['volunteers'] as $key => $volunteer)
                                            <tr id="volunteer-row{{ $key }}">                                      
                                                <td><input type="text" class="form-control form-control-sm" name="volunteer[{{ $key }}][year]" onkeypress="return isNumberKey(event)" maxlength="4" value="{{ $volunteer['year'] }}" required></td>                                        
                                                <td><input type="text" class="form-control form-control-sm" name="volunteer[{{ $key }}][experience]" value="{{ $volunteer['experience'] }}" required></td>
                                                <td><select class="form-select form-control-sm" name="volunteer[{{ $key }}][red_cross_involvement]" required><option value="">Select</option><option value="Yes" {{ $volunteer['red_cross_envolvement'] == "Yes" ? "selected" : "" }}>Yes</option><option value="No" {{ $volunteer['red_cross_envolvement'] == "No" ? "selected" : "" }}>No</option></select></td>
                                                <td class="text-end"><button class="btn btn-sm btn-danger" onclick="$('#volunteer-row{{ $key }}').remove();"><i class="mdi mdi-delete"></i></button></td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr id="volunteer-row0">                                      
                                                <td><input type="text" class="form-control form-control-sm" name="volunteer[0][year]" onkeypress="return isNumberKey(event)" maxlength="4" required></td>                                        
                                                <td><input type="text" class="form-control form-control-sm" name="volunteer[0][experience]" required></td>
                                                <td><select class="form-select form-control-sm" name="volunteer[0][red_cross_involvement]" required><option value="">Select</option><option value="Yes">Yes</option><option value="No">No</option></select></td>
                                                <td class="text-end"><button class="btn btn-sm btn-danger" onclick="$('#volunteer-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                            </tr>
                                            @endif
                                        @else
                                        <tr id="volunteer-row0">                                      
                                            <td><input type="text" class="form-control form-control-sm" name="volunteer[0][year]" onkeypress="return isNumberKey(event)" maxlength="4" required></td>                                        
                                            <td><input type="text" class="form-control form-control-sm" name="volunteer[0][experience]" required></td>
                                            <td><select class="form-select form-control-sm" name="volunteer[0][red_cross_involvement]" required><option value="">Select</option><option value="Yes">Yes</option><option value="No">No</option></select></td>
                                            <td class="text-end"><button class="btn btn-sm btn-danger" onclick="$('#volunteer-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                        </tr>
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end">
                                                <button type="button" class="btn btn-sm btn-info"
                                                    onclick="addVolunteership();"><i class="mdi mdi-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tfoot>                                
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('education-background.form') }}"
                            class="btn btn-sm btn-warning float-start">Previous
                            Step</a>
                        <button type="submit" form="specialInformationForm"
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
@push('scripts')
<script>
     @isset($special_information)
        @if(count($special_information['volunteers']) > 0)
            var volunteer_row = {{ count($special_information['volunteers']) }};
        @else
            var volunteer_row = 1;
        @endif
    @else
        var volunteer_row = 1;
    @endisset
    function addVolunteership(){
        html =  '<tr id="volunteer-row' +volunteer_row+ '">';       
        html += '<td><input type="text" class="form-control form-control-sm" name="volunteer[' +volunteer_row+ '][year]" onkeypress="return isNumberKey(event)" maxlength="4" required></td>';    
        html += '<td><input type="text" class="form-control form-control-sm" name="volunteer[' +volunteer_row+ '][experience]" required></td>';
        html += '<td><select class="form-select form-control-sm" name="volunteer[0][red_cross_involvement]" required><option value="">Select</option><option value="Yes">Yes</option><option value="No">No</option></select></td>';
        html += '<td class="text-end"><button class="btn btn-sm btn-danger" onclick="$(\'#volunteer-row' + volunteer_row + '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
        html += '</tr>';

        $('#volunteers tbody').append(html);

        volunteer_row++;
    }
</script>
@endpush