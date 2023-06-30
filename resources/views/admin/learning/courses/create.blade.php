@extends('layouts.admin')
@section('title', 'Create Course')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Courses</a></li>
                            <li class="breadcrumb-item active">Create Course</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Course</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.courses.store') }}" id="courseForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Course Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <code id="name-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                                                        
                            <div class="col-md-6 mb-2">
                                <label for="statuses" class="form-label">Status<span
                                        class="text-danger">*</span></label>
                                <select name="status" id="statuses" class="form-select">
                                    <option value="" selected>Please Select</option>                                    
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>    
                            
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Course description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" placeholder="Course description" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <code id="description-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                                               
                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="courseForm">Save</button>
                                <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
