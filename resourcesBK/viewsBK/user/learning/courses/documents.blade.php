@extends('layouts.user')
@section('title', 'Course Documents')
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
                            <li class="breadcrumb-item active">Course Documents</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Course Documents</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title">{{ $course->name }}</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('learning.courses') }}" class="btn btn-sm btn-dark me-1">Back</a>                               
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                @if (count($documents) > 0)
                                    <ul class="list-group">
                                        @foreach ($documents as $document)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <a href="{{ asset('storage/uploads/courses/'.$course->id.'/documents'.'/'. $document->document) }}" download="">{{ $document->title }}</a>
                                                <div class="btn-group mb-2">
                                                    <a href="{{ asset('storage/uploads/courses/'.$course->id.'/documents'.'/'. $document->document) }}" download=""  class="btn btn-warning text-dark me-1 btn-sm"><i class="mdi mdi-download"></i></a>                                                                                              
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-center py-5">No Document Found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
