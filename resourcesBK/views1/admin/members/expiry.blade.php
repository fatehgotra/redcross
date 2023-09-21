@extends('layouts.admin')
@section('title', 'Add Membership Expiry')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.members.index') }}">Members</a></li>
                            <li class="breadcrumb-item active">Add Membership Expiry</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Membership Expiry</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.members.expiry-update', $user->id) }}" id="expiryForm"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Membership Expiry Date</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd"
                                    class="form-control" name="expiry_date" id="expiry_date" placeholder="Expiry Date"
                                    value="{{ old('expiry_date', $user->expiry_date ) }}" autocomplete="off">
                                @error('expiry_date')
                                    <code id="expiry_date-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="expiryForm">Update</button>
                                <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
