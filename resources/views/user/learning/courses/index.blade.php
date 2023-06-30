@extends('layouts.user')
@section('title', 'Courses')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Courses</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($courses as $course)
                            <div class="col-md-4">
                                <div class="card border-warning border">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $course->name }}</h5>
                                        <p class="card-text text-center">{{ $course->description }}</p>                                                                       
                                    </div>
                                    <div class="card-footer">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <a href="{{ route('learning.take-test', $course->id) }}" class="text-dark">
                                                    <p class="font-18 mb-0"><i class="dripicons-blog"></i></p>
                                                    <h6 class="text-truncate d-block">Take Test</h6>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('learning.watch-videos', $course->id) }}" class="text-dark">
                                                    <p class="font-18 mb-0"><i class="dripicons-device-desktop"></i></p>
                                                    <h6 class="text-truncate d-block">Watch Videos</h6>
                                                </a>
                                            </div>
                                        </div>        
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
@endsection
