@extends('layouts.hq')
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
                            <li class="breadcrumb-item active">Service Interest</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Volunteer Details</h4>
                </div>
            </div>
        </div>
        @include('hq.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>  
                        </div>
                        <div class="float-end">
                            @if($user->status == 'approve' && $user->approved_by == 'HQ')
                            <button class="btn btn-sm btn-success" disabled type="button"><i class="me-1 dripicons-checkmark"></i>Approved</button>
                            @elseif($user->status == 'decline' && $user->approved_by == 'HQ')
                            <button class="btn btn-sm btn-danger" disabled type="button"><i class="me-1 dripicons-cross"></i>Declined</button>
                            @else
                            <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i class="me-1 dripicons-checkmark"></i>Approve</a>
                            
                            <a href="javascript:void(0);" onclick="confirmDecline()" class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>
                            <form id='approve-form'
                            action='{{ route('hq.change-status', $user->id) }}'
                            method='POST'>
                            <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                            <input type='hidden' name='status' value='approve'>
<input type='hidden' name='_method' value='PUT'>
                        </form>
                            <form id='decline-form'
                                action='{{ route('hq.change-status', $user->id) }}'
                                method='POST'>
                                <input type='hidden' name='_token'
                                    value='{{ csrf_token() }}'>
                                <input type='hidden' name='status' value='decline'>
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
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.lodge-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.personal-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.contact-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('hq.volunteer-detail.identification-and-employement-details.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.education-background.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.special-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link active show" href="{{ route('hq.volunteer-detail.service-interest.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.banking-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link" href="{{ route('hq.volunteer-detail.consents-and-checks.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Service Interest</h4>
                    </div>
                    <div class="card-body">                       
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="service_interest" class="col-form-label">Service Interest (Select all that
                                        applies) <span class="text-danger">*</span></label>
                                    <select id="service_interest"
                                        class="form-select select2 @error('service_interest') is-invalid @enderror"
                                        name="service_interest[]" data-toggle="select2"
                                        data-placeholder="Select Service Interest" multiple disabled>
                                        <option value="">Select Service Interest(s)</option>
                                        <option value="Marking, Events & Communications"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Marking, Events & Communications') ? 'selected' : '' }}>
                                            Marking, Events & Communications
                                        </option>
                                        <option value="Logistics"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Logistics') ? 'selected' : '' }}>
                                            Logistics
                                        </option>
                                        <option value="Disaster"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Disaster') ? 'selected' : '' }}>
                                            Disaster
                                        </option>
                                        <option value="Warehouse"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Warehouse') ? 'selected' : '' }}>
                                            Warehouse
                                        </option>
                                        <option value="Safety"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Safety') ? 'selected' : '' }}>
                                            Safety
                                        </option>
                                        <option value="Health & PGI"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Health & PGI') ? 'selected' : '' }}>
                                            Health & PGI
                                        </option>
                                        <option value="Youth"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Youth') ? 'selected' : '' }}>
                                            Youth
                                        </option>
                                        <option value="Administration"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Administration') ? 'selected' : '' }}>
                                            Administration
                                        </option>
                                        <option value="ICT"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('ICT') ? 'selected' : '' }}>
                                            ICT
                                        </option>
                                        <option value="Finance"
                                            {{ collect(old('service_interest', isset($service_interest) ? $service_interest->service_interest : ''))->contains('Finance') ? 'selected' : '' }}>
                                            Finance
                                        </option>
                                    </select>
                                    @error('service_interest')
                                        <small id="service_interest-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="available_days" class="col-form-label">Which Days are you availlable ?
                                        (Select
                                        all that applies) <span class="text-danger">*</span></label>
                                    <select id="available_days"
                                        class="form-select select2 @error('available_days') is-invalid @enderror"
                                        name="available_days[]" data-toggle="select2" data-placeholder="Select Day(s)"
                                        multiple disabled>
                                        <option value="">Select Day(s)</option>
                                        <option value="Monday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Monday') ? 'selected' : '' }}>
                                            Monday
                                        </option>
                                        <option value="Tuesday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Tuesday') ? 'selected' : '' }}>
                                            Tuesday
                                        </option>
                                        <option value="Wednesday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Wednesday') ? 'selected' : '' }}>
                                            Wednesday
                                        </option>
                                        <option value="Thursday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Thursday') ? 'selected' : '' }}>
                                            Thursday
                                        </option>
                                        <option value="Friday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Friday') ? 'selected' : '' }}>
                                            Friday
                                        </option>
                                        <option value="Saturday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Saturday') ? 'selected' : '' }}>
                                            Saturday
                                        </option>
                                        <option value="Sunday"
                                            {{ collect(old('available_days', isset($service_interest) ? $service_interest->available_days : ''))->contains('Sunday') ? 'selected' : '' }}>
                                            Sunday
                                        </option>
                                    </select>
                                    @error('available_days')
                                        <small id="available_days-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="available_times" class="col-form-label">Which Times are you availlable ?
                                        (Select
                                        all that applies) <span class="text-danger">*</span></label>
                                    <select id="available_times"
                                        class="form-select select2 @error('available_times') is-invalid @enderror"
                                        name="available_times[]" data-toggle="select2" data-placeholder="Select Time(s)"
                                        multiple disabled>
                                        <option value="">Select Time(s)</option>
                                        <option value="Morning: 06:00 AM to 10:00 AM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('Morning: 06:00 AM to 10:00 AM') ? 'selected' : '' }}>
                                            Morning: 06:00 AM to 10:00 AM
                                        </option>
                                        <option value="Midday: 10:00 AM to 02:00 PM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('Midday: 10:00 AM to 02:00 PM') ? 'selected' : '' }}>
                                            Midday: 10:00 AM to 02:00 PM
                                        </option>
                                        <option value="Mid-afternoon: 02:00 PM to 06:00 PM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('Mid-afternoon: 02:00 PM to 06:00 PM') ? 'selected' : '' }}>
                                            Mid-afternoon: 02:00 PM to 06:00 PM
                                        </option>
                                        <option value="After Hours: After 06:00 PM"
                                            {{ collect(old('available_times', isset($service_interest) ? $service_interest->available_times : ''))->contains('After Hours: After 06:00 PM') ? 'selected' : '' }}>
                                            After Hours: After 06:00 PM
                                        </option>
                                    </select>
                                    @error('available_times')
                                        <small id="available_times-error" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="other_skills" class="col-form-label">In the event of a disaster, what
                                        other skills can you support the team with?</label>
                                    <textarea name="other_skills" id="other_skills" class="form-control" readonly>{{ old('other_skills', isset($service_interest) ? $service_interest->other_skills : '') }}</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('hq.volunteers.index') }}" class="btn btn-sm btn-dark float-end">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
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