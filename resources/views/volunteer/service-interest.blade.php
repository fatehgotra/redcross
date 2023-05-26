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
                    <h4 class="header-title text-center fw-bold">Service Interest</h4>
                    <p class="text-center text-muted">Step 11</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('service-interest') }}" method="POST" id="serviceInterestForm">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="service_interest" class="col-form-label">Service Interest (Select all that
                                    applies) <span class="text-danger">*</span></label>
                                <select id="service_interest"
                                    class="form-select select2 @error('service_interest') is-invalid @enderror"
                                    name="service_interest[]" data-toggle="select2"
                                    data-placeholder="Select Service Interest" multiple>
                                    <option value="">Select Service Interest(s)</option>
                                    <option value="Marking, Events & Communications"
                                        {{ collect(old('service_interest'))->contains('Marking, Events & Communications') ? 'selected' : '' }}>
                                        Marking, Events & Communications
                                    </option>
                                    <option value="Logistics"
                                        {{ collect(old('service_interest'))->contains('Logistics') ? 'selected' : '' }}>
                                        Logistics
                                    </option>
                                    <option value="Disaster"
                                        {{ collect(old('service_interest'))->contains('Disaster') ? 'selected' : '' }}>
                                        Disaster
                                    </option>
                                    <option value="Warehouse"
                                        {{ collect(old('service_interest'))->contains('Warehouse') ? 'selected' : '' }}>
                                        Warehouse
                                    </option>
                                    <option value="Safety"
                                        {{ collect(old('service_interest'))->contains('Safety') ? 'selected' : '' }}>
                                        Safety
                                    </option>
                                    <option value="Health & PGI"
                                        {{ collect(old('service_interest'))->contains('Health & PGI') ? 'selected' : '' }}>
                                        Health & PGI
                                    </option>
                                    <option value="Youth"
                                        {{ collect(old('service_interest'))->contains('Youth') ? 'selected' : '' }}>
                                        Youth
                                    </option>
                                    <option value="Administration"
                                        {{ collect(old('service_interest'))->contains('Administration') ? 'selected' : '' }}>
                                        Administration
                                    </option>
                                    <option value="ICT"
                                        {{ collect(old('service_interest'))->contains('ICT') ? 'selected' : '' }}>
                                        ICT
                                    </option>
                                    <option value="Finance"
                                        {{ collect(old('service_interest'))->contains('Finance') ? 'selected' : '' }}>
                                        Finance
                                    </option>
                                </select>
                                @error('service_interest')
                                    <small id="service_interest-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="available_days" class="col-form-label">Which Days are you availlable ? (Select
                                    all that applies) <span class="text-danger">*</span></label>
                                <select id="available_days"
                                    class="form-select select2 @error('available_days') is-invalid @enderror"
                                    name="available_days[]" data-toggle="select2" data-placeholder="Select Day(s)" multiple>
                                    <option value="">Select Day(s)</option>
                                    <option value="Monday"
                                        {{ collect(old('available_days'))->contains('Monday') ? 'selected' : '' }}>
                                        Monday
                                    </option>
                                    <option value="Tuesday"
                                        {{ collect(old('available_days'))->contains('Tuesday') ? 'selected' : '' }}>Tuesday
                                    </option>
                                    <option value="Wednesday"
                                        {{ collect(old('available_days'))->contains('Wednesday') ? 'selected' : '' }}>
                                        Wednesday
                                    </option>
                                    <option value="Thursday"
                                        {{ collect(old('available_days'))->contains('Thursday') ? 'selected' : '' }}>
                                        Thursday
                                    </option>
                                    <option value="Friday"
                                        {{ collect(old('available_days'))->contains('Friday') ? 'selected' : '' }}>
                                        Friday
                                    </option>
                                    <option value="Saturday"
                                        {{ collect(old('available_days'))->contains('Saturday') ? 'selected' : '' }}>
                                        Saturday
                                    </option>
                                    <option value="Sunday"
                                        {{ collect(old('available_days'))->contains('Sunday') ? 'selected' : '' }}>
                                        Sunday
                                    </option>
                                </select>
                                @error('available_days')
                                    <small id="available_days-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="available_times" class="col-form-label">Which Times are you availlable ? (Select
                                    all that applies) <span class="text-danger">*</span></label>
                                <select id="available_times"
                                    class="form-select select2 @error('available_times') is-invalid @enderror"
                                    name="available_times[]" data-toggle="select2" data-placeholder="Select Time(s)"
                                    multiple>
                                    <option value="">Select Time(s)</option>
                                    <option value="Morning: 06:00 AM to 10:00 AM"
                                        {{ collect(old('available_times'))->contains('Morning: 06:00 AM to 10:00 AM') ? 'selected' : '' }}>
                                        Morning: 06:00 AM to 10:00 AM
                                    </option>
                                    <option value="Midday: 10:00 AM to 02:00 PM"
                                        {{ collect(old('available_times'))->contains('Midday: 10:00 AM to 02:00 PM') ? 'selected' : '' }}>
                                        Midday: 10:00 AM to 02:00 PM
                                    </option>
                                    <option value="Mid-afternoon: 02:00 PM to 06:00 PM"
                                        {{ collect(old('available_times'))->contains('Mid-afternoon: 02:00 PM to 06:00 PM') ? 'selected' : '' }}>
                                        Mid-afternoon: 02:00 PM to 06:00 PM
                                    </option>
                                    <option value="After Hours: After 06:00 PM"
                                        {{ collect(old('available_times'))->contains('After Hours: After 06:00 PM') ? 'selected' : '' }}>
                                        After Hours: After 06:00 PM
                                    </option>
                                </select>
                                @error('available_times')
                                    <small id="available_times-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="other_skills" class="col-form-label">In the event of a disaster, what other skills can you support the tea with?</label>
                                <textarea name="other_skills" id="other_skills" class="form-control">{{ old('other_skills') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('special-information.form') }}" class="btn btn-sm btn-warning float-start">Previous
                        Step</a>
                    <button type="submit" form="serviceInterestForm" class="btn btn-sm btn-success float-end">Next
                        Step</button>
                </div>
            </div>
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
