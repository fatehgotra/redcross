@extends('layouts.admin')
@section('title', 'Edit Video')
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
                            <li class="breadcrumb-item active">Edit Video</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Video</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.videos.update', $video->id) }}" id="videoForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">                   
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <label for="course_id" class="form-label">Course<span class="text-danger">*</span></label>
                                <select name="course_id" id="course_id" class="form-select">
                                    <option value="" selected>Please Select</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id', $video->course_id) == $course->id ? "selected" : "" }}>{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <code id="course_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="statuses" class="form-label">Status<span class="text-danger">*</span></label>
                                <select name="status" id="statuses" class="form-select">
                                    <option value="" selected>Please Select</option>
                                    <option value="1" {{ old('status', $video->status) == 1 ? "selected" : "" }}>Active</option>
                                    <option value="0" {{ old('status', $video->status) == 0 ? "selected" : "" }}>Inactive</option>
                                </select>
                                @error('status')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="url" class="form-label">Video URL <span class="text-danger">*</span></label>
                                <input type="url" class="form-control" name="url" id="url"
                                    placeholder="Video URL" value="{{ old('url', $video->url) }}">
                                @error('url')
                                    <code id="url-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">Video Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Video Title" value="{{ old('title', $video->title) }}">
                                @error('title')
                                    <code id="title-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Video Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description"
                                    placeholder="Video Description" rows="3">{{ old('description', $video->description) }}</textarea>
                                @error('description')
                                    <code id="description-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="videoForm">Update</button>
                                <a href="{{ route('admin.videos.index') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
