@extends('layouts.branch-level')
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
                            <li class="breadcrumb-item active">Education Background</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Volunteer Details</h4>
                </div>
            </div>
        </div>
        @include('branch-level.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>  
                        </div>
                        <div class="float-end">
                            @if($user->status == 'approve')
                            <button class="btn btn-sm btn-success" disabled type="button"><i class="me-1 dripicons-checkmark"></i>Approved</button>
                            @elseif($user->status == 'decline')
                            <button class="btn btn-sm btn-danger" disabled type="button"><i class="me-1 dripicons-cross"></i>Declined</button>
                            @else
                            <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i class="me-1 dripicons-checkmark"></i>Approve</a>
                            
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal" class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>
                            <form id='approve-form'
                            action='{{ route('branch-level.change-status', $user->id) }}'
                            method='POST'>
                            <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                            <input type='hidden' name='status' value='approve'>
<input type='hidden' name='_method' value='PUT'>
                        </form>
                            
                            @endif
                        </div>                      
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.lodge-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.personal-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.contact-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.identification-and-employement-details.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link active show"
                                href="{{ route('branch-level.volunteer-detail.education-background.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.special-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.service-interest.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.banking-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('branch-level.volunteer-detail.consents-and-checks.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Education Background</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <label for="highest_level_of_education" class="col-form-label">Highest Level of Education
                                <span class="text-danger">*</span></label>
                            <select id="highest_level_of_education"
                                class="form-select @error('highest_level_of_education') is-invalid @enderror"
                                name="highest_level_of_education" disabled>
                                <option value="">Select Highest Level of Education</option>
                                <option value="Doctorate"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Doctorate' ? 'selected' : '' }}>
                                    Doctorate
                                </option>
                                <option value="Degree"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Degree' ? 'selected' : '' }}>
                                    Degree
                                </option>
                                <option value="Certificate"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Certificate' ? 'selected' : '' }}>
                                    Certificate
                                </option>
                                <option value="Primary Schoool"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Primary Schoool' ? 'selected' : '' }}>
                                    Primary Schoool
                                </option>
                                <option value="Secondary School"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Secondary School' ? 'selected' : '' }}>
                                    Secondary School
                                </option>
                                <option value="Special School"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Special School' ? 'selected' : '' }}>
                                    Special School
                                </option>
                                <option value="Masters"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Masters' ? 'selected' : '' }}>
                                    Masters
                                </option>
                                <option value="Foundation"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Foundation' ? 'selected' : '' }}>
                                    Foundation
                                </option>
                                <option value="Year 11"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Year 11' ? 'selected' : '' }}>
                                    Year 11
                                </option>
                                <option value="Year 12"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Year 12' ? 'selected' : '' }}>
                                    Year 12
                                </option>
                                <option value="Diploma"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Diploma' ? 'selected' : '' }}>
                                    Diploma
                                </option>
                                <option value="Post graduation Diploma"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'Post graduation Diploma' ? 'selected' : '' }}>
                                    Post graduation Diploma
                                </option>
                                <option value="No Formal Education"
                                    {{ old('highest_level_of_education', isset($education_background) ? $education_background->highest_level_of_education : '') == 'No Formal' ? 'selected' : '' }}>
                                    No Formal
                                </option>

                            </select>
                            @error('highest_level_of_education')
                                <small id="highest_level_of_education-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label class="col-form-label">List Other Work or Professional Skills: (e.g. driver,
                                carpentdr, welder etc.)</label>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-sm table-bordered" id="skills">
                                <thead>
                                    <tr>
                                        <th style="width: 50%">Skill</th>
                                        <th>Evidence of Skills <br>(e.g. certificates or reference letters)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($skills) > 0)
                                        @foreach ($skills as $key => $skill)
                                            <tr id="skill-row{{ $key }}">
                                                <td><input type="hidden" name="skill[{{ $key }}][id]"
                                                        value="{{ $skill->id }}"><input type="text"
                                                        class="form-control form-control-sm"
                                                        name="skill[{{ $key }}][skill]"
                                                        value="{{ $skill->skill }}" required readonly></td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm"
                                                            name="skill[{{ $key }}][evidence]" disabled>
                                                        @isset($skill->evidence)
                                                            <a href="{{ asset('storage/uploads/users/' . $user->id . '/skills' . '/' . $skill->evidence) }}"
                                                                download="" class="btn btn-warning download-label"><i
                                                                    class="mdi mdi-download"></i></a>
                                                        @endisset
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No Skills added
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Qualifications</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <label class="col-form-label">Tertiary Qualifications Attained (including Vocational
                                Programs) </label>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-sm table-bordered" id="qualifications">
                                <thead>
                                    <tr>
                                        <th>Year</th>
                                        <th>Institution</th>
                                        <th>Course / Field of Study</th>
                                        <th>Course Status</th>
                                        <th>Upload Evidence of Course Completed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($qualifications) > 0)
                                        @foreach ($qualifications as $key => $qualification)
                                            <tr id="qualification-row0">
                                                <td><input type="hidden" name="qualification[{{ $key }}][id]"
                                                        value="{{ $qualification->id }}"><input type="text"
                                                        class="form-control form-control-sm"
                                                        name="qualification[{{ $key }}][year]"
                                                        onkeypress="return isNumberKey(event)" maxlength="4"
                                                        value="{{ $qualification->year }}" required readonly></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        name="qualification[{{ $key }}][institution]"
                                                        value="{{ $qualification->institution }}" required readonly></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        name="qualification[{{ $key }}][course]"
                                                        value="{{ $qualification->course }}" required readonly></td>
                                                <td>
                                                    <select name="qualification[{{ $key }}][course_status]"
                                                        class="form-select form-control-sm" required disabled>
                                                        <option value="">Select</option>
                                                        <option value="Complete"
                                                            {{ $qualification->course_status == 'Complete' ? 'selected' : '' }}>
                                                            Complete</option>
                                                        <option value="Ongoing"
                                                            {{ $qualification->course_status == 'Ongoing' ? 'selected' : '' }}>
                                                            Ongoing</option>
                                                        <option value="Incomplete"
                                                            {{ $qualification->course_status == 'Incomplete' ? 'selected' : '' }}>
                                                            Incomplete</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control form-control-sm"
                                                            name="qualification[{{ $key }}][evidence]" disabled>
                                                        @isset($qualification->evidence)
                                                            <a href="{{ asset('storage/uploads/users/' . $user->id . '/qualifications' . '/' . $qualification->evidence) }}"
                                                                download="" class="btn btn-warning download-label"><i
                                                                    class="mdi mdi-download"></i></a>
                                                        @endisset
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="qualification-row0">
                                            <td colspan="6" class="text-end">
                                                No Qualifications added
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('branch-level.volunteers.index') }}" class="btn btn-sm btn-dark float-end">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
 @include('branch-level.users.volunteer-details.modals.decline-modal')
@endsection
@push('scripts')
    <script>
        @if (count($qualifications) > 0)
            var qualification_row = {{ count($qualifications) }};
        @else
            var qualification_row = 1;
        @endif
        function addQualification() {
            html = '<tr id="qualification-row' + qualification_row + '">';
            html += '<td><input type="text" class="form-control form-control-sm" name="qualification[' + qualification_row +
                '][year]" onkeypress="return isNumberKey(event)" maxlength="4" required></td>';
            html += '<td><input type="text" class="form-control form-control-sm" name="qualification[' + qualification_row +
                '][institution]" required></td>'
            html += '<td><input type="text" class="form-control form-control-sm" name="qualification[' + qualification_row +
                '][course]" required></td>'
            html += '<td><select  class="form-select form-control-sm" name="qualification[' + qualification_row +
                '][course_status]" required><option value="">Select</option><option value="Complete">Complete</option><option value="Ongoing">Ongoing</option><option value="Incomplete">Incomplete</option></select></td>';
            html += '<td><input type="file" class="form-control form-control-sm" name="qualification[' + qualification_row +
                '][evidence]"></td>';
            html += '<td><button class="btn btn-sm btn-danger" onclick="$(\'#qualification-row' + qualification_row +
                '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
            html += '</tr>';

            $('#qualifications tbody').append(html);

            qualification_row++;
        }
    </script>
    <script>
        @if (count($skills) > 0)
            var skill_row = {{ count($skills) }};
        @else
            var skill_row = 1;
        @endif
        function addSkill() {
            html = '<tr id="skill-row' + skill_row + '">';
            html += '<td><input type="text" class="form-control form-control-sm" name="skill[' + skill_row +
                '][skill]" required></td>'
            html += '<td><input type="file" class="form-control form-control-sm" name="skill[' + skill_row +
                '][evidence]"></td>';
            html += '<td class="text-end"><button class="btn btn-sm btn-danger" onclick="$(\'#skill-row' + skill_row +
                '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
            html += '</tr>';

            $('#skills tbody').append(html);

            skill_row++;
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
