@php
    $consents_and_checks = Session::get('consents-and-checks');
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
            <form action="{{ route('consents-and-checks') }}" method="POST" id="consentAndChecksForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Referee Information</h4>
                        <p class="text-center text-muted">Step 14</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-sm table-bordered" id="referees">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Organisation</th>
                                            <th>Contact Number</th>
                                            <th>Email Contact</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($consents_and_checks)
                                            @if(count($consents_and_checks['referees']) > 0)
                                                @foreach ($consents_and_checks['referees'] as $key => $referee)
                                                    <tr id="referee-row{{ $key }}">
                                                        <td><input type="text" class="form-control form-control-sm" name="referee[{{ $key }}][name]" value="{{ $referee['name'] }}"></td>
                                                        <td><input type="text" class="form-control form-control-sm" name="referee[{{ $key }}][role]" value="{{ $referee['role'] }}"></td>
                                                        <td><input type="text" class="form-control form-control-sm" name="referee[{{ $key }}][organisation]" value="{{ $referee['organisation'] }}"></td>
                                                        <td><input type="text" class="form-control form-control-sm" name="referee[{{ $key }}][contact_number]" value="{{ $referee['contact_number'] }}"></td>
                                                        <td><input type="email" class="form-control form-control-sm" name="referee[{{ $key }}][email]" value="{{ $referee['email'] }}"></td>
                                                        <td><button class="btn btn-sm btn-danger" onclick="$('#referee-row{{ $key }}').remove();"><i class="mdi mdi-delete"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr id="referee-row0">
                                                    <td><input type="text" class="form-control form-control-sm" name="referee[0][name]"></td>
                                                    <td><input type="text" class="form-control form-control-sm" name="referee[0][role]"></td>
                                                    <td><input type="text" class="form-control form-control-sm" name="referee[0][organisation]"></td>
                                                    <td><input type="text" class="form-control form-control-sm" name="referee[0][contact_number]"></td>
                                                    <td><input type="email" class="form-control form-control-sm" name="referee[0][email]"></td>
                                                    <td><button class="btn btn-sm btn-danger" onclick="$('#referee-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                                </tr>
                                            @endif
                                        @else
                                        <tr id="referee-row0">
                                            <td><input type="text" class="form-control form-control-sm" name="referee[0][name]"></td>
                                            <td><input type="text" class="form-control form-control-sm" name="referee[0][role]"></td>
                                            <td><input type="text" class="form-control form-control-sm" name="referee[0][organisation]"></td>
                                            <td><input type="text" class="form-control form-control-sm" name="referee[0][contact_number]"></td>
                                            <td><input type="email" class="form-control form-control-sm" name="referee[0][email]"></td>
                                            <td><button class="btn btn-sm btn-danger" onclick="$('#referee-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                        </tr>
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-end">
                                                <button type="button" class="btn btn-sm btn-info"
                                                    onclick="addReferee();"><i class="mdi mdi-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tfoot>                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Consents </h4>
                        <p class="text-center text-muted">Step 15</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="consent_to_be_contacted" class="col-form-label">Consent to be Contacted <span
                                        class="text-danger">*</span></label>
                                <select id="consent_to_be_contacted"
                                    class="form-select @error('consent_to_be_contacted') is-invalid @enderror"
                                    name="consent_to_be_contacted">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('consent_to_be_contacted', isset($consents_and_checks) ? $consents_and_checks['consent_to_be_contacted'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('consent_to_be_contacted', isset($consents_and_checks) ? $consents_and_checks['consent_to_be_contacted'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('consent_to_be_contacted')
                                    <small id="consent_to_be_contacted-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="consent_to_background_check" class="col-form-label">Consent to Background Check <span
                                        class="text-danger">*</span></label>
                                <select id="consent_to_background_check"
                                    class="form-select @error('consent_to_background_check') is-invalid @enderror"
                                    name="consent_to_background_check">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('consent_to_background_check', isset($consents_and_checks) ? $consents_and_checks['consent_to_background_check'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('consent_to_background_check', isset($consents_and_checks) ? $consents_and_checks['consent_to_background_check'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('consent_to_background_check')
                                    <small id="consent_to_background_check-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="parental_consent" class="col-form-label">Parental Consent (For Minors) <span
                                        class="text-danger">*</span></label>
                                <select id="parental_consent"
                                    class="form-select @error('parental_consent') is-invalid @enderror"
                                    name="parental_consent">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('parental_consent', isset($consents_and_checks) ? $consents_and_checks['parental_consent'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('parental_consent', isset($consents_and_checks) ? $consents_and_checks['parental_consent'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('parental_consent')
                                    <small id="parental_consent-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="media_consent" class="col-form-label">Media Consent <span
                                        class="text-danger">*</span></label>
                                <select id="media_consent"
                                    class="form-select @error('media_consent') is-invalid @enderror"
                                    name="media_consent">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('media_consent', isset($consents_and_checks) ? $consents_and_checks['media_consent'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('media_consent', isset($consents_and_checks) ? $consents_and_checks['media_consent'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('media_consent')
                                    <small id="media_consent-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="agree_to_code_of_conduct" class="col-form-label">Agree to <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#code-of-conduct">Code of Conduct (CoC)</a> <span
                                        class="text-danger">*</span></label>
                                <select id="agree_to_code_of_conduct"
                                    class="form-select @error('agree_to_code_of_conduct') is-invalid @enderror"
                                    name="agree_to_code_of_conduct">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('agree_to_code_of_conduct', isset($consents_and_checks) ? $consents_and_checks['agree_to_code_of_conduct'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('agree_to_code_of_conduct', isset($consents_and_checks) ? $consents_and_checks['agree_to_code_of_conduct'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('agree_to_code_of_conduct')
                                    <small id="agree_to_code_of_conduct-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="agree_to_child_protection_policy" class="col-form-label">Agree to <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#child-protection-policy">Child Protection Policy (CPP)</a> <span
                                        class="text-danger">*</span></label>
                                <select id="agree_to_child_protection_policy"
                                    class="form-select @error('agree_to_child_protection_policy') is-invalid @enderror"
                                    name="agree_to_child_protection_policy">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('agree_to_child_protection_policy', isset($consents_and_checks) ? $consents_and_checks['agree_to_child_protection_policy'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('agree_to_child_protection_policy', isset($consents_and_checks) ? $consents_and_checks['agree_to_child_protection_policy'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('agree_to_child_protection_policy')
                                    <small id="agree_to_child_protection_policy-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Checks </h4>
                        <p class="text-center text-muted">Step 16</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="statutory_declaration_attached" class="col-form-label">Statutory Declaration Attached <span
                                        class="text-danger">*</span></label>
                                <select id="statutory_declaration_attached"
                                    class="form-select @error('statutory_declaration_attached') is-invalid @enderror"
                                    name="statutory_declaration_attached">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('statutory_declaration_attached', isset($consents_and_checks) ? $consents_and_checks['statutory_declaration_attached'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('statutory_declaration_attached', isset($consents_and_checks) ? $consents_and_checks['statutory_declaration_attached'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('statutory_declaration_attached')
                                    <small id="statutory_declaration_attached-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="code_of_conduct_attached" class="col-form-label">Code of Conduct Attached <span
                                        class="text-danger">*</span></label>
                                <select id="code_of_conduct_attached"
                                    class="form-select @error('code_of_conduct_attached') is-invalid @enderror"
                                    name="code_of_conduct_attached">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('code_of_conduct_attached', isset($consents_and_checks) ? $consents_and_checks['code_of_conduct_attached'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('code_of_conduct_attached', isset($consents_and_checks) ? $consents_and_checks['code_of_conduct_attached'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('code_of_conduct_attached')
                                    <small id="code_of_conduct_attached-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="signed_child_protection_policy_attached" class="col-form-label">Signed Child Protection Policy Attached <span
                                        class="text-danger">*</span></label>
                                <select id="signed_child_protection_policy_attached"
                                    class="form-select @error('signed_child_protection_policy_attached') is-invalid @enderror"
                                    name="signed_child_protection_policy_attached">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('signed_child_protection_policy_attached', isset($consents_and_checks) ? $consents_and_checks['signed_child_protection_policy_attached'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('signed_child_protection_policy_attached', isset($consents_and_checks) ? $consents_and_checks['signed_child_protection_policy_attached'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('signed_child_protection_policy_attached')
                                    <small id="signed_child_protection_policy_attached-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="cv_attached" class="col-form-label">CV Attached <span
                                        class="text-danger">*</span></label>
                                <select id="cv_attached"
                                    class="form-select @error('cv_attached') is-invalid @enderror"
                                    name="cv_attached">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('cv_attached', isset($consents_and_checks) ? $consents_and_checks['cv_attached'] : '') == 'Yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ old('cv_attached', isset($consents_and_checks) ? $consents_and_checks['cv_attached'] : '') == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('cv_attached')
                                    <small id="cv_attached-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="base_location" class="col-form-label">Base Location <span
                                        class="text-danger">*</span></label>
                                <select id="base_location"
                                    class="form-select @error('base_location') is-invalid @enderror"
                                    name="base_location">
                                    <option value="">Select</option>
                                    <option value="Branch" {{ old('base_location', isset($consents_and_checks) ? $consents_and_checks['base_location'] : '') == 'Branch' ? 'selected' : '' }}>
                                        Branch
                                    </option>
                                    <option value="Community (CBV)" {{ old('base_location', isset($consents_and_checks) ? $consents_and_checks['base_location'] : '') == 'Community (CBV)' ? 'selected' : '' }}>Community (CBV)
                                    </option>
                                    <option value="Office" {{ old('base_location', isset($consents_and_checks) ? $consents_and_checks['base_location'] : '') == 'Office' ? 'selected' : '' }}>Office
                                    </option>
                                </select>
                                @error('base_location')
                                    <small id="base_location-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('banking-information.form') }}"
                            class="btn btn-sm btn-warning float-start">Previous
                            Step</a>
                        <button type="submit" form="consentAndChecksForm" class="btn btn-sm btn-success float-end">Next
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
    @include('volunteer.modals.code-of-conduct')
    @include('volunteer.modals.child-protection-policy')
@endsection
@push('scripts')
<script>
    @isset($consents_and_checks)
        @if(count($consents_and_checks['referees']) > 0)
            var referee_row = {{ count($consents_and_checks['referees']) }};
        @else
            var referee_row = 1;
        @endif
    @else
        var referee_row = 1;
    @endisset
    function addReferee(){
        html =  '<tr id="referee-row' +referee_row+ '">';       
        html += '<td><input type="text" class="form-control form-control-sm" name="referee[' +referee_row+ '][name]"></td>'
        html += '<td><input type="text" class="form-control form-control-sm" name="referee[' +referee_row+ '][role]"></td>'            
        html += '<td><input type="text" class="form-control form-control-sm" name="referee[' +referee_row+ '][organisation]"></td>'      
        html += '<td><input type="text" class="form-control form-control-sm" name="referee[' +referee_row+ '][contact_number]"></td>'      
        html += '<td><input type="email" class="form-control form-control-sm" name="referee[' +referee_row+ '][email]"></td>';
        html += '<td class="text-end"><button class="btn btn-sm btn-danger" onclick="$(\'#referee-row' + referee_row + '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
        html += '</tr>';

        $('#referees tbody').append(html);

        referee_row++;
    }
</script>
@endpush