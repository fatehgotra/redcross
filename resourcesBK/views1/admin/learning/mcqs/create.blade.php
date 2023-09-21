@extends('layouts.admin')
@section('title', 'Create MCQ')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.mcqs.index') }}">MCQs</a></li>
                            <li class="breadcrumb-item active">Create MCQ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create MCQ</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.mcqs.store') }}" id="questionForm" enctype="multipart/form-data">
        @csrf
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
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? "selected" : "" }}>{{ $course->name }}</option>
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
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="question" id="question"
                                    placeholder="Question" value="{{ old('question') }}">
                                @error('question')
                                    <code id="question-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="option_1" class="form-label">Option 1 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_1" id="option_1"
                                    placeholder="Option 1" rows="3">{{ old('option_1') }}</textarea>
                                @error('option_1')
                                    <code id="option_1-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="option_2" class="form-label">Option 2 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_2" id="option_2"
                                    placeholder="Option 2" rows="3">{{ old('option_2') }}</textarea>
                                @error('option_2')
                                    <code id="option_2-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="option_3" class="form-label">Option 3 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_3" id="option_3"
                                    placeholder="Option 3" rows="3">{{ old('option_3') }}</textarea>
                                @error('option_3')
                                    <code id="option_3-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="option_4" class="form-label">Option 4 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_4" id="option_4"
                                    placeholder="Option 4" rows="3">{{ old('option_4') }}</textarea>
                                @error('option_4')
                                    <code id="option_4-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="correct_option" class="form-label">Correct Option<span class="text-danger">*</span></label>
                                <select name="correct_option" id="correct_option" class="form-select">
                                    <option value="" selected>Please Select</option>
                                    <option value="1" {{ old('correct_option') == 1 ? "selected" : "" }}>Option 1</option>
                                    <option value="2" {{ old('correct_option') == 2 ? "selected" : "" }}>Option 2</option>
                                    <option value="3" {{ old('correct_option') == 3 ? "selected" : "" }}>Option 3</option>
                                    <option value="4" {{ old('correct_option') == 4 ? "selected" : "" }}>Option 4</option>
                                </select>
                                @error('correct_option')
                                    <code id="correct_option-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="questionForm">Save</button>
                                <a href="{{ route('admin.mcqs.index') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
