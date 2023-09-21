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
                            <label class="col-form-label" >Select ticket type<span class="text-danger">*</span></label>
                            <select name="enquiry_type" required class="form-control" id="enquiry_type">
                                <option value="">-- select ticket type --</option>
                                <option value="Course Query">Course query</option>
                                <option value="Reward Point Query">Reward points query</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('enquiry_type')
                            <code id="enquiry_type-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label class="col-form-label">Query Description</label>
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