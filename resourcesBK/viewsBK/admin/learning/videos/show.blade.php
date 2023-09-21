@extends('layouts.admin')
@section('title', 'Show Video')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.videos.index') }}">Videos</a></li>
                            <li class="breadcrumb-item active">Show Video</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Show Video</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-xl-12">               

                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ $video->title }}</h4>
                        <p class="text-muted font-14"><code>COURSE NAME: {{ $video->course->name }}</code></p>

                        <div class="ratio ratio-4x3">
                            <iframe src="{{ $video->url }}"></iframe>
                        </div>       
                    </div>
                    <div class="card-footer">
                        <p class="text-muted font-14">{{ $video->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection