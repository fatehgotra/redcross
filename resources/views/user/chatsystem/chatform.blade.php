@extends('layouts.user')
@section('title', 'Create Chat Ticket')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Create Chat Ticket</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Chat Ticket</h4>
            </div>
        </div>
    </div>
    @include('user.includes.flash-message')
  
    <div class="row">

        <div class="col-sm-12">
            <div class="card chat-system">
                <div class="card-body">
                    <form id="sendform" method="POST" action="{{ route('chat-request') }}">
                        @csrf
                        <div class="form-group mb-1">
                            <input type="email" id="email" placeholder="Enter your email" name="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <code id="email-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <select name="enquiry_type" class="form-control" id="enquiry_type">
                                <option>-- select ticket type --</option>
                                <option value="course_query">Course query</option>
                                <option value="reward_points_query">Reward points query</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('enquiry_type')
                            <code id="enquiry_type-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control texta" id="description" placeholder="Enter your initial query message.."></textarea>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary" form="sendform">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection