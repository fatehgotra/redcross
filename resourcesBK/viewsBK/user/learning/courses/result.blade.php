@extends('layouts.user')
@section('title', 'Results')
@section('content')

@php
$percentage = ($attempt->correct / count($attempt->responses) * 100);
$ends_at = \Carbon\Carbon::parse($attempt->ends_at);
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                        <li class="breadcrumb-item active">Results</li>
                    </ol>
                </div>
                <h4 class="page-title">Results</h4>
            </div>
        </div>
    </div>
    @include('user.includes.flash-message')
    <div class="row">
        <div class="col-sm-12">
            <div class="card cta-box bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="w-100 overflow-hidden">
                            <h3 class="mt-0 text-white"><i class="mdi mdi-bullhorn-outline"></i>&nbsp;Hello&nbsp;&nbsp;{{ Auth::user()->firstname }}
                                {{ Auth::user()->lastname }}!
                            </h3>
                            <h4 class="m-0 font-weight-normal cta-box-title text-white">Your Test report is ready . . .
                            </h4>
                        </div>
                        <img class="ms-3" src="{{ asset('assets/images/email-campaign.svg') }}" width="120" alt="Generic placeholder image">
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <div class="card cta-box bg-warning text-white">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <h3 class="m-0 font-weight-normal cta-box-title"><b>{{ $attempt->course->name }}</b>
                            @if( $percentage >= 80 )
                                <a href="{{ route('certificate', ['id' => base64_encode($attempt->user_id), 'course_id' => base64_encode($attempt->course->id), 'attempt'=>base64_encode($attempt->id) ] ) }}" class="btn btn-info" style="float:right"> Get Certificate </a>
                            @endif
                            </h3>
                            <p class="text-dark">{{ $attempt->course->description }}</p>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="card cta-box bg-info text-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="dripicons-question float-right text-muted"></i>
                                    <h2 class="m-b-20">{{ count($attempt->responses) }}</h2>
                                    <span class="text-muted">Total Questions</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->

                        <div class="col-sm-4">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="dripicons-checkmark float-right text-muted"></i>
                                    <h2 class="m-b-20">{{ $attempt->correct }}</h2>
                                    <span class="text-muted">Correct Answers</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->

                        <div class="col-sm-4">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="dripicons-cross float-right text-muted"></i>
                                    <h2 class="m-b-20">{{ $attempt->incorrect }}</h2>
                                    <span class="text-muted">Wrong Answers</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="uil-check-square float-right text-muted"></i>
                                    <h2 class="m-b-20">{{ count($attempt->attempted) }}</h2>
                                    <span class="text-muted">Attempted</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->

                        <div class="col-sm-4">
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class="uil-times-square float-right text-muted"></i>
                                    <h2 class="m-b-20">{{ $attempt->unattempted }}</h2>
                                    <span class="text-muted">Unattempted</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->

                        <div class="col-sm-4">
                            <div class="card tilebox-one">
                                <div class="card-body">

                                    @if($percentage >= 80)
                                    <h2 class="m-b-20 text-success">Pass</h2>
                                    @else
                                    <h2 class="m-b-20 text-danger">Fail</h2>
                                    @endif
                                    <span class="text-muted">{{round($percentage, 2)}} %</span>
                                </div> <!-- end card-body-->
                            </div>
                            <!--end card-->
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card tilebox-one widget-flat bg-success text-white">
                <div class="card-body">
                    <h2 class="float-end text-white">
                        {{ $attempt->correct }}/{{ count($attempt->responses) }}
                    </h2>
                    <h2 class="m-b-20">Test Score</h2>
                </div>
            </div>
            <div class="card text-white bg-dark overflow-hidden">
                <div class="card-body">
                    <div class="toll-free-box text-center text-white">
                        <h4 class="text-white"> <i class="mdi mdi-deskphone"></i><a href="tel:+679 992 0297">+679 992
                                0297</a></h4>
                    </div>
                </div> <!-- end card-body-->
            </div>
            <div class="card text-white bg-dark overflow-hidden">
                <div class="card-body">
                    <div class="toll-free-box text-center text-white">
                        <h4 class="text-white"> <i class="uil-envelope"></i><a href="mailto:info@redcross.com.fj">info@redcross.com.fj</a></h4>
                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($responses as $response)
        <div class="col-md-12 col-lg-12">
            <div class="card border-secondary border">
                <div class="card-header">
                    <span class="float-start"><strong>Question {{ $loop->iteration }}</strong></span>
                    <span class="float-end">
                        @if ($response->attempted == 'yes')
                        <button class="btn btn-info btn-sm">Attempted</button>
                        @if ($response->correct == 'yes')
                        <button class="btn btn-success btn-sm">Correct</button>
                        @else
                        <button class="btn btn-danger btn-sm">Incorrect</button>
                        @endif
                        @else
                        <button class="btn btn-dark btn-sm">Unattempted</button>
                        @endif
                    </span>
                </div>
                <div class="card-header bg-warning">
                    {{ $response->question->question }}
                </div>
                <div class="card-body">
                    <span class="flexy-span my-2">
                        @if ($response->option == 1 && $response->question->correct_option == 1)
                        <i class="mdi mdi-check-circle font-18 text-success mr-2"></i>
                        @elseif($response->option == 1 && $response->question->correct_option !== 1)
                        <i class="mdi mdi-close-circle font-18 text-danger mr-2"></i>
                        @elseif($response->option !== 1 && $response->question->correct_option == 1)
                        {{-- <i class="mdi mdi-check-circle font-18 text-success mr-2"></i> --}}
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @else
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @endif

                        {!! $response->question->option_1 !!}

                    </span>
                    <br>
                    <span class="flexy-span my-2">
                        @if ($response->option == 2 && $response->question->correct_option == 2)
                        <i class="mdi mdi-check-circle font-18 text-success mr-2"></i>
                        @elseif($response->option == 2 && $response->question->correct_option !== 2)
                        <i class="mdi mdi-close-circle font-18 text-danger mr-2"></i>
                        @elseif($response->option !== 2 && $response->question->correct_option == 2)
                        {{-- <i class="mdi mdi-check-circle font-18 text-success mr-2"></i> --}}
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @else
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @endif

                        {!! $response->question->option_2 !!}

                    </span>
                    <br>
                    <span class="flexy-span my-2">
                        @if ($response->option == 3 && $response->question->correct_option == 3)
                        <i class="mdi mdi-check-circle font-18 text-success mr-2"></i>
                        @elseif($response->option == 3 && $response->question->correct_option !== 3)
                        <i class="mdi mdi-close-circle font-18 text-danger mr-2"></i>
                        @elseif($response->option !== 3 && $response->question->correct_option == 3)
                        {{-- <i class="mdi mdi-check-circle font-18 text-success mr-2"></i> --}}
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @else
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @endif

                        {!! $response->question->option_3 !!}

                        </label>
                    </span>
                    <br>
                    <span class="flexy-span my-2">
                        @if ($response->option == 4 && $response->question->correct_option == 4)
                        <i class="mdi mdi-check-circle font-18 text-success mr-2"></i>
                        @elseif($response->option == 4 && $response->question->correct_option !== 4)
                        <i class="mdi mdi-close-circle font-18 text-danger mr-2"></i>
                        @elseif($response->option !== 4 && $response->question->correct_option == 4)
                        {{-- <i class="mdi mdi-check-circle font-18 text-success mr-2"></i> --}}
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @else
                        <i class="mdi mdi-circle-double font-18 text-light mr-2"></i>
                        @endif

                        {!! $response->question->option_4 !!}

                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection