@extends('layouts.user')
@section('title', 'Results')
@section('content')
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
                <div class="card bg-info">
                    <h6 class="text-center py-5">Development in progress</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
