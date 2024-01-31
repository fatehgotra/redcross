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
                            <li class="breadcrumb-item active">Consents & Checks</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> My Profile</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <form action="{{ route('my-profile.consents-and-checks') }}" method="POST" id="consentAndChecksForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
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
                                <a class="nav-link" href="{{ route('my-profile.special-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Special Information
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.service-interest.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Service Interests
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.banking-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Banking Information
                                </a>
                                <a class="nav-link active show" href="{{ route('my-profile.consents-and-checks.form') }}">
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Consents </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="consent_to_be_contacted" class="col-form-label">Consent to be Contacted
                                        <span class="text-danger">*</span></label>
                                    <select id="consent_to_be_contacted"
                                        class="form-select @error('consent_to_be_contacted') is-invalid @enderror"
                                        name="consent_to_be_contacted">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('consent_to_be_contacted', isset($consents) ? $consents->consent_to_be_contacted : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('consent_to_be_contacted', isset($consents) ? $consents->consent_to_be_contacted : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('consent_to_be_contacted')
                                        <small id="consent_to_be_contacted-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="consent_to_background_check" class="col-form-label">Consent to Background
                                        Check <span class="text-danger">*</span></label>
                                    <select id="consent_to_background_check"
                                        class="form-select @error('consent_to_background_check') is-invalid @enderror"
                                        name="consent_to_background_check">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('consent_to_background_check', isset($consents) ? $consents->consent_to_background_check : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('consent_to_background_check', isset($consents) ? $consents->consent_to_background_check : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('consent_to_background_check')
                                        <small id="consent_to_background_check-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="parental_consent" class="col-form-label">Parental Consent (For Minors) <span
                                            class="text-danger">*</span></label>
                                    <select id="parental_consent"
                                        class="form-select @error('parental_consent') is-invalid @enderror"
                                        name="parental_consent">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('parental_consent', isset($consents) ? $consents->parental_consent : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('parental_consent', isset($consents) ? $consents->parental_consent : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('parental_consent')
                                        <small id="parental_consent-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="media_consent" class="col-form-label">Media Consent <span
                                            class="text-danger">*</span></label>
                                    <select id="media_consent"
                                        class="form-select @error('media_consent') is-invalid @enderror"
                                        name="media_consent">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('media_consent', isset($consents) ? $consents->media_consent : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('media_consent', isset($consents) ? $consents->media_consent : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('media_consent')
                                        <small id="media_consent-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="agree_to_code_of_conduct" class="col-form-label">Agree to <a
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#code-of-conduct">Code of Conduct (CoC)</a> <span
                                            class="text-danger">*</span></label>
                                    <select id="agree_to_code_of_conduct"
                                        class="form-select @error('agree_to_code_of_conduct') is-invalid @enderror"
                                        name="agree_to_code_of_conduct">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('agree_to_code_of_conduct', isset($consents) ? $consents->agree_to_code_of_conduct : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('agree_to_code_of_conduct', isset($consents) ? $consents->agree_to_code_of_conduct : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('agree_to_code_of_conduct')
                                        <small id="agree_to_code_of_conduct-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="agree_to_child_protection_policy" class="col-form-label">Agree to <a
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#child-protection-policy">Child Protection Policy (CPP)</a>
                                        <span class="text-danger">*</span></label>
                                    <select id="agree_to_child_protection_policy"
                                        class="form-select @error('agree_to_child_protection_policy') is-invalid @enderror"
                                        name="agree_to_child_protection_policy">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('agree_to_child_protection_policy', isset($consents) ? $consents->agree_to_child_protection_policy : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('agree_to_child_protection_policy', isset($consents) ? $consents->agree_to_child_protection_policy : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('agree_to_child_protection_policy')
                                        <small id="agree_to_child_protection_policy-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="age_under_18" class="col-form-label">Age Under 18 <span
                                            class="text-danger">*</span></label>
                                    <select id="age_under_18"
                                        class="form-select @error('age_under_18') is-invalid @enderror"
                                        name="age_under_18">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('age_under_18', isset($consents) ? $consents->age_under_18 : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('age_under_18', isset($consents) ? $consents->age_under_18 : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('age_under_18')
                                        <small id="age_under_18-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Checks </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="statutory_declaration_attached" class="col-form-label">Statutory
                                        Declaration Attached <span class="text-danger">*</span></label>
                                    <select id="statutory_declaration_attached"
                                        class="form-select @error('statutory_declaration_attached') is-invalid @enderror"
                                        name="statutory_declaration_attached">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('statutory_declaration_attached', isset($checks) ? $checks->statutory_declaration_attached : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('statutory_declaration_attached', isset($checks) ? $checks->statutory_declaration_attached : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('statutory_declaration_attached')
                                        <small id="statutory_declaration_attached-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="statutory_declaration" class="col-form-label">Upload Statutory Declaration</label>
                                    <div class="input-group">
                                        <input id="statutory_declaration" type="file"
                                            class="form-control @error('statutory_declaration') is-invalid @enderror" name="statutory_declaration">
                                        @isset($checks->statutory_declaration)
                                            <a href="{{ asset('storage/uploads/users/'.Auth::user()->id.'/checks'.'/'. $checks->statutory_declaration) }}"
                                                download="" class="btn btn-warning download-label"><i
                                                    class="mdi mdi-download"></i></a>
                                        @endisset
                                    </div>
                                    @error('statutory_declaration')
                                        <small id="statutory_declaration-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="code_of_conduct_attached" class="col-form-label">Code of Conduct Attached
                                        <span class="text-danger">*</span></label>
                                    <select id="code_of_conduct_attached"
                                        class="form-select @error('code_of_conduct_attached') is-invalid @enderror"
                                        name="code_of_conduct_attached">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('code_of_conduct_attached', isset($checks) ? $checks->code_of_conduct_attached : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('code_of_conduct_attached', isset($checks) ? $checks->code_of_conduct_attached : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('code_of_conduct_attached')
                                        <small id="code_of_conduct_attached-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="code_of_conduct" class="col-form-label">Upload Code of Conduct</label>
                                    <div class="input-group">
                                        <input id="code_of_conduct" type="file"
                                            class="form-control @error('code_of_conduct') is-invalid @enderror" name="code_of_conduct">
                                        @isset($checks->code_of_conduct)
                                            <a href="{{ asset('storage/uploads/users/'.Auth::user()->id.'/checks'.'/'. $checks->code_of_conduct) }}"
                                                download="" class="btn btn-warning download-label"><i
                                                    class="mdi mdi-download"></i></a>
                                        @endisset
                                    </div>
                                    @error('code_of_conduct')
                                        <small id="code_of_conduct-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="signed_child_protection_policy_attached" class="col-form-label">Signed
                                        Child Protection Policy Attached <span class="text-danger">*</span></label>
                                    <select id="signed_child_protection_policy_attached"
                                        class="form-select @error('signed_child_protection_policy_attached') is-invalid @enderror"
                                        name="signed_child_protection_policy_attached">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('signed_child_protection_policy_attached', isset($checks) ? $checks->signed_child_protection_policy_attached : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('signed_child_protection_policy_attached', isset($checks) ? $checks->signed_child_protection_policy_attached : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('signed_child_protection_policy_attached')
                                        <small id="signed_child_protection_policy_attached-error"
                                            class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="signed_child_protection_policy" class="col-form-label">Upload Signed Child Protection Policy</label>
                                    <div class="input-group">
                                        <input id="signed_child_protection_policy" type="file"
                                            class="form-control @error('signed_child_protection_policy') is-invalid @enderror" name="signed_child_protection_policy">
                                        @isset($checks->signed_child_protection_policy)
                                            <a href="{{ asset('storage/uploads/users/'.Auth::user()->id.'/checks'.'/'. $checks->signed_child_protection_policy) }}"
                                                download="" class="btn btn-warning download-label"><i
                                                    class="mdi mdi-download"></i></a>
                                        @endisset
                                    </div>
                                    @error('signed_child_protection_policy')
                                        <small id="signed_child_protection_policy-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="professional_volunteer" class="col-form-label">Professional Volunteer <span
                                            class="text-danger">*</span></label>
                                    <select id="professional_volunteer"
                                        class="form-select @error('professional_volunteer') is-invalid @enderror" name="professional_volunteer">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('professional_volunteer', isset($checks) ? $checks->professional_volunteer : '') == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('professional_volunteer', isset($checks) ? $checks->professional_volunteer : '') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('professional_volunteer')
                                        <small id="professional_volunteer-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="professional_volunteer_attachment" class="col-form-label">Professional Volunteer Attachment</label>
                                    <div class="input-group">
                                        <input id="professional_volunteer_attachment" type="file"
                                            class="form-control @error('professional_volunteer_attachment') is-invalid @enderror" name="professional_volunteer_attachment">
                                        @isset($checks->professional_volunteer_attachment)
                                            <a href="{{ asset('storage/uploads/users/'.Auth::user()->id.'/checks'.'/'. $checks->professional_volunteer_attachment) }}"
                                                download="" class="btn btn-warning download-label"><i
                                                    class="mdi mdi-download"></i></a>
                                        @endisset
                                    </div>
                                    @error('professional_volunteer_attachment')
                                        <small id="professional_volunteer_attachment-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="base_location" class="col-form-label">Base Location <span
                                            class="text-danger">*</span></label>
                                    <select id="base_location"
                                        class="form-select @error('base_location') is-invalid @enderror"
                                        name="base_location">
                                        <option value="">Select</option>
                                        <option value="Branch"
                                            {{ old('base_location', isset($checks) ? $checks->base_location : '') == 'Branch' ? 'selected' : '' }}>
                                            Branch
                                        </option>
                                        <option value="Community (CBV)"
                                            {{ old('base_location', isset($checks) ? $checks->base_location : '') == 'Community (CBV)' ? 'selected' : '' }}>
                                            Community (CBV)
                                        </option>
                                        <option value="Office"
                                            {{ old('base_location', isset($checks) ? $checks->base_location : '') == 'Office' ? 'selected' : '' }}>
                                            Office
                                        </option>
                                    </select>
                                    @error('base_location')
                                        <small id="base_location-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title text-center fw-bold">Referee Information</h4>
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
                                            @if (count($referees) > 0)
                                                @foreach ($referees as $key => $referee)
                                                    <tr id="referee-row{{ $key }}">
                                                        <td><input type="text" class="form-control form-control-sm"
                                                                name="referee[{{ $key }}][name]"
                                                                value="{{ $referee->name }}"></td>
                                                        <td><input type="text" class="form-control form-control-sm"
                                                                name="referee[{{ $key }}][role]"
                                                                value="{{ $referee->role }}"></td>
                                                        <td><input type="text" class="form-control form-control-sm"
                                                                name="referee[{{ $key }}][organisation]"
                                                                value="{{ $referee->organisation }}"></td>
                                                        <td><input type="text" class="form-control form-control-sm"
                                                                name="referee[{{ $key }}][contact_number]"
                                                                value="{{ $referee->contact_number }}"></td>
                                                        <td><input type="email" class="form-control form-control-sm"
                                                                name="referee[{{ $key }}][email]"
                                                                value="{{ $referee->email }}"></td>
                                                        <td><button class="btn btn-sm btn-danger"
                                                                onclick="$('#referee-row{{ $key }}').remove();"><i
                                                                    class="mdi mdi-delete"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr id="referee-row0">
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[0][name]"></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[0][role]"></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[0][organisation]"></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[0][contact_number]"></td>
                                                    <td><input type="email" class="form-control form-control-sm"
                                                            name="referee[0][email]"></td>
                                                    <td><button class="btn btn-sm btn-danger"
                                                            onclick="$('#referee-row0').remove();"><i
                                                                class="mdi mdi-delete"></i></button></td>
                                                </tr>
                                            @endif

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
                        <div class="card-footer">
                            <button type="submit" form="consentAndChecksForm"
                                class="btn btn-sm btn-success float-end">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('user.my-profile.modals.child-protection-policy')
    @include('user.my-profile.modals.code-of-conduct')
@endsection
@push('scripts')
    <script>
        @if (count($referees) > 0)
            var referee_row = {{ count($referees) }};
        @else
            var referee_row = 1;
        @endif

        function addReferee() {
            html = '<tr id="referee-row' + referee_row + '">';
            html += '<td><input type="text" class="form-control form-control-sm" name="referee[' + referee_row +
                '][name]"></td>'
            html += '<td><input type="text" class="form-control form-control-sm" name="referee[' + referee_row +
                '][role]"></td>'
            html += '<td><input type="text" class="form-control form-control-sm" name="referee[' + referee_row +
                '][organisation]"></td>'
            html += '<td><input type="text" class="form-control form-control-sm" name="referee[' + referee_row +
                '][contact_number]"></td>'
            html += '<td><input type="email" class="form-control form-control-sm" name="referee[' + referee_row +
                '][email]"></td>';
            html += '<td class="text-end"><button class="btn btn-sm btn-danger" onclick="$(\'#referee-row' + referee_row +
                '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
            html += '</tr>';

            $('#referees tbody').append(html);

            referee_row++;
        }
    </script>
@endpush
