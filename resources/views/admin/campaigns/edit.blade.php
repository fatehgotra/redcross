@extends('layouts.admin')
@section('title', 'Edit Campaign')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
                            <li class="breadcrumb-item active">Edit Campaign</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Campaign</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.campaigns.update', $campaign->id) }}" id="supplierForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Campaign Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">Campaign Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Campaign Title" value="{{ old('title', $campaign->title) }}">
                                @error('title')
                                    <code id="title-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" rows="10" placeholder="description">{{ old('description', $campaign->description) }}</textarea>
                                @error('description')
                                    <code id="description-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="starts_at" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input id="starts_at" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd"
                                    class="form-control" name="starts_at" value="{{ old('starts_at', $campaign->starts_at) }}"
                                    autocomplete="starts_at" placeholder="Start Date">
                                @error('starts_at')
                                    <code id="description-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="ends_at" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input id="ends_at" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd"
                                    class="form-control" name="ends_at" value="{{ old('ends_at', $campaign->ends_at) }}" autocomplete="ends_at"
                                    placeholder="End Date">
                                @error('ends_at')
                                    <code id="description-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="entry_closed" class="form-label"> Entry Closed<span class="text-danger">*</span></label>
                                <select name="entry_closed" id="statuses" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="0" {{ old('entry_closed', $campaign->entry_closed) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('entry_closed', $campaign->entry_closed) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                                @error('entry_closed')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="supplierForm">Save</button>
                                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-dark">Cancel</a>
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
