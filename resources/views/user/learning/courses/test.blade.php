@extends('layouts.user')
@section('title', 'Take Test')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $course->name }}</a></li>
                            <li class="breadcrumb-item active">Take Test</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Take Test</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <form method="POST" action="{{ route('learning.submit-test', $course->id) }}" id="testForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="test_attempt_id" value="{{ $attempt->id }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-info">
                        <div class="card-body profile-user-box">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row align-items-center">

                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">{{ $course->name }}</h4>
                                                <p class="font-13 text-dark-50"> {{ $course->description }}</p>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <h5 class="mb-1">50</h5>
                                                        <p class="mb-0 font-13 text-dark">Total Rewards Points</p>
                                                    </li>
                                                    <li class="list-inline-item me-3">
                                                        <h5 class="mb-1">{{ count($course->questions) }}</h5>
                                                        <p class="mb-0 font-13 text-dark">Number of Questions</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                        <a href="{{ route('learning.courses') }}" class="btn btn-danger"><i
                                                class="dripicons-exit me-1"></i>Exit</a>
                                        <button type="submit" class="btn btn-dark" form="testForm">
                                            <i class="dripicons-rocket me-1"></i> Submit Test
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($course->questions as $question)
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-secondary border">
                            <div class="card-header">
                                <strong>Question {{ $loop->iteration }} :</strong>
                            </div>
                            <div class="card-header bg-warning">
                                {{ $question->question }}
                            </div>
                            <div class="card-body">                                
                                <input type="hidden" name="question[{{ $loop->iteration }}][question_id]"
                                    value="{{ $question->id }}">
                                <div class="form-check form-radio-success mb-2">
                                    <input type="radio" id="answer{{ $loop->iteration }}option1"
                                        name="question[{{ $loop->iteration }}][answer]" class="form-check-input"
                                        value="1">
                                    <label class="form-check-label"
                                        for="answer{{ $loop->iteration }}option1">{{ $question->option_1 }}</label>
                                </div>
                                <div class="form-check form-radio-success mb-2">
                                    <input type="radio" id="answer{{ $loop->iteration }}option2"
                                        name="question[{{ $loop->iteration }}][answer]" class="form-check-input"
                                        value="2">
                                    <label class="form-check-label"
                                        for="answer{{ $loop->iteration }}option2">{{ $question->option_2 }}</label>
                                </div>
                                <div class="form-check form-radio-success mb-2">
                                    <input type="radio" id="answer{{ $loop->iteration }}option3"
                                        name="question[{{ $loop->iteration }}][answer]" class="form-check-input"
                                        value="3">
                                    <label class="form-check-label"
                                        for="answer{{ $loop->iteration }}option3">{{ $question->option_3 }}</label>
                                </div>
                                <div class="form-check form-radio-success mb-2">
                                    <input type="radio" id="answer{{ $loop->iteration }}option4"
                                        name="question[{{ $loop->iteration }}][answer]" class="form-check-input"
                                        value="4">
                                    <label class="form-check-label"
                                        for="answer{{ $loop->iteration }}option4">{{ $question->option_4 }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 col-lg-12">
                        <div class="card d-block">
                            <div class="card-body">
                                <h5 class="card-title text-center py-5">No questions added by administrator</h5>
                            </div>
                        </div>
                    </div>
                @endforelse

                @if (count($course->questions) > 0)
                    <div class="col-md-12 col-lg-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark" form="testForm">
                                <i class="dripicons-rocket me-1"></i> Submit Test
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
@endsection
