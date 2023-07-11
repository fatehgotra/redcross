@extends('layouts.admin')
@section('title', 'Edit Alert')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.alerts.index') }}">Alerts</a></li>
                            <li class="breadcrumb-item active">Edit Alert</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Alert</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.alerts.update', $alert->id) }}" id="supplierForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Alert Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">Alert Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Alert Title" value="{{ old('title', $alert->title) }}">
                                @error('title')
                                    <code id="title-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Alert Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" rows="10" placeholder="Alert Description">{{ old('description', $alert->description) }}</textarea>
                                @error('description')
                                    <code id="description-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="priority" class="form-label">Priority<span class="text-danger">*</span></label>
                                <select name="priority" id="priority" class="form-select">
                                    <option value="">Select Priority</option>
                                    <option value="Low" {{ old('priority', $alert->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                                    <option value="Medium" {{ old('priority', $alert->priority) == 'Medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="High" {{ old('priority', $alert->priority) == 'High' ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="statuses" class="form-label">Save as<span class="text-danger">*</span></label>
                                <select name="status" id="statuses" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="0" {{ old('status', $alert->status) == 0 ? 'selected' : '' }}>Draft</option>
                                    <option value="1" {{ old('status', $alert->status) == 1 ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="supplierForm">Update</button>
                                <a href="{{ route('admin.alerts.index') }}" class="btn btn-sm btn-dark">Cancel</a>
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
            selector: 'textarea#description',
            height: 300,
            menubar: false,
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help ',            
                          
        });
    </script>
@endpush