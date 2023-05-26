@extends('layouts.app')
@section('title', 'Home | Fiji Red Cross Society')
@section('content')
    <section>
        <div class="container py-3">
            <img src="{{ asset('assets/images/banner.jpg') }}" alt="" class="img-fluid">
        </div>
    </section>
    <section>
        <div class="container py-2 text-center">
            <h4>The <span class="text-danger"> Fiji Red Cross Society </span>is a humanitarian organization that provides assistance to vulnerable communities in Fiji. </h4>
            <h4>Our mission is to alleviate human suffering, promote health and well-being, and support disaster preparedness and response. </h4>
            <p>We work with volunteers, partners, and donors to deliver programs and services that address the needs of those most in need. </p>
            <p>Our organization is committed to upholding the fundamental principles of the Red Cross and Red Crescent Movement, including humanity, impartiality, neutrality, independence, voluntary service, unity, and universality.</p>
            <a class="btn btn-sm btn-info" href="{{ route('lodge-information.form') }}"><i class="mdi mdi-water text-danger me-1"></i>Volunteer Now</a>
        </div>
    </section>
@endsection
