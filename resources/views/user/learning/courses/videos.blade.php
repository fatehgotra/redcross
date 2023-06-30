@extends('layouts.user')
@section('title', 'Watch Videos')
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
                            <li class="breadcrumb-item active">Watch Videos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Watch Videos</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
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
                                                    <h5 class="mb-1">{{ count($course->videos) }}</h5>
                                                    <p class="mb-0 font-13 text-dark">Number of Videos</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                 <a href="{{ route('learning.courses') }}" class="btn btn-danger"><i class="dripicons-exit me-1"></i>Exit</a>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($course->videos as $video)
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{ $video->title }}</h4>
                            <p class="text-muted font-14"><code>COURSE NAME: {{ $video->course->name }}</code></p>

                            <div class="ratio ratio-4x3">
                                <iframe src="{{ $video->url }}" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="text-muted font-14">{{ $video->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 col-lg-12">
                    <div class="card d-block">
                        <div class="card-body">
                            <h5 class="card-title text-center py-5">No videos added by administrator</h5>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
