@extends('layouts.admin')
@section('title', 'Volunteer Details')
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
                            <li class="breadcrumb-item">Volunteer Details</li>
                            <li class="breadcrumb-item active">Consents & Checks</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Volunteer Details</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>
                        </div>
                        @include('admin.users.volunteer-details.section.approval-section')
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.lodge-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.personal-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.contact-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.identification-and-employement-details.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.education-background.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.special-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.service-interest.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.volunteer-detail.banking-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link active show"
                                href="{{ route('admin.volunteer-detail.consents-and-checks.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
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
                                    name="consent_to_be_contacted" disabled>
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
                                    <small id="consent_to_be_contacted-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="consent_to_background_check" class="col-form-label">Consent to Background
                                    Check <span class="text-danger">*</span></label>
                                <select id="consent_to_background_check"
                                    class="form-select @error('consent_to_background_check') is-invalid @enderror"
                                    name="consent_to_background_check" disabled>
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
                                    name="parental_consent" disabled>
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
                                    class="form-select @error('media_consent') is-invalid @enderror" name="media_consent"
                                    disabled>
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
                                    name="agree_to_code_of_conduct" disabled>
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
                                    name="agree_to_child_protection_policy" disabled>
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
                                    class="form-select @error('age_under_18') is-invalid @enderror" name="age_under_18"
                                    disabled>
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
                                    name="statutory_declaration_attached" disabled>
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
                                <label for="code_of_conduct_attached" class="col-form-label">Code of Conduct Attached
                                    <span class="text-danger">*</span></label>
                                <select id="code_of_conduct_attached"
                                    class="form-select @error('code_of_conduct_attached') is-invalid @enderror"
                                    name="code_of_conduct_attached" disabled>
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
                                <label for="signed_child_protection_policy_attached" class="col-form-label">Signed
                                    Child Protection Policy Attached <span class="text-danger">*</span></label>
                                <select id="signed_child_protection_policy_attached"
                                    class="form-select @error('signed_child_protection_policy_attached') is-invalid @enderror"
                                    name="signed_child_protection_policy_attached" disabled>
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
                                <label for="professional_volunteer" class="col-form-label">Professional Volunteer <span
                                        class="text-danger">*</span></label>
                                <select id="professional_volunteer" class="form-select @error('professional_volunteer') is-invalid @enderror"
                                    name="professional_volunteer" disabled>
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
                            <div class="col-lg-12">
                                <label for="base_location" class="col-form-label">Base Location <span
                                        class="text-danger">*</span></label>
                                <select id="base_location"
                                    class="form-select @error('base_location') is-invalid @enderror" name="base_location"
                                    disabled>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($referees) > 0)
                                            @foreach ($referees as $key => $referee)
                                                <tr id="referee-row{{ $key }}">
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[{{ $key }}][name]"
                                                            value="{{ $referee->name }}" readonly></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[{{ $key }}][role]"
                                                            value="{{ $referee->role }}" readonly></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[{{ $key }}][organisation]"
                                                            value="{{ $referee->organisation }}" readonly></td>
                                                    <td><input type="text" class="form-control form-control-sm"
                                                            name="referee[{{ $key }}][contact_number]"
                                                            value="{{ $referee->contact_number }}" readonly></td>
                                                    <td><input type="email" class="form-control form-control-sm"
                                                            name="referee[{{ $key }}][email]"
                                                            value="{{ $referee->email }}" readonly></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    No Referee Found
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.volunteers.index') }}" class="btn btn-sm btn-dark float-end">Back</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    @include('admin.users.volunteer-details.modals.child-protection-policy')
    @include('admin.users.volunteer-details.modals.code-of-conduct')
    @include('admin.users.volunteer-details.modals.decline-modal')
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmAccept(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve Volunteer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-form').submit();
                }
            })
        };
    </script>
    <script type="text/javascript">
        function confirmDecline(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Decline Volunteer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('decline-form').submit();
                }
            })
        };
    </script>
@endpush
