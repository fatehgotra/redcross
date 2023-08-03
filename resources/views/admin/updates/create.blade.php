@extends('layouts.admin')
@section('title', 'Add Update')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.updates.index') }}">Updates</a></li>
                            <li class="breadcrumb-item active">Add Update</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Update</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.updates.store') }}" id="supplierForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Update Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">Update / News Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Update / News Title" value="{{ old('title') }}">
                                @error('title')
                                    <code id="title-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="content" class="form-label">Content <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="content" id="content" rows="10" placeholder="Content">{{ old('content') }}</textarea>
                                @error('content')
                                    <code id="content-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>                           
                            <div class="col-md-12 mb-2">
                                <label for="statuses" class="form-label">Save as<span class="text-danger">*</span></label>
                                <select name="status" id="statuses" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="supplierForm">Save</button>
                                <a href="{{ route('admin.updates.index') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.9/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            height: 300,
            menubar: false,
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help ',           
                          
        });
    </script>
@endpush