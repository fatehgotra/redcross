@extends('layouts.admin')
@section('title', 'Course Documents')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Courses</a></li>
                            <li class="breadcrumb-item active">Course Documents</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Course Documents</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title">{{ $course->name }}</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-dark me-1">Back</a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#upload-document-modal"
                                    class="btn btn-sm btn-success float-end">Add
                                    Document</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                @if (count($documents) > 0)
                                    <ul class="list-group">
                                        @foreach ($documents as $document)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <a href="{{ asset('storage/uploads/courses/'.$course->id.'/documents'.'/'. $document->document) }}" download="">{{ $document->title }}</a>
                                                <div class="btn-group mb-2">
                                                    <a href="{{ asset('storage/uploads/courses/'.$course->id.'/documents'.'/'. $document->document) }}" download=""  class="btn btn-warning text-dark me-1 btn-sm"><i class="mdi mdi-download"></i></a>
                                                    <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $document->id }})"
                                                            class="btn btn-sm  btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                                        <form id='delete-form{{ $document->id }}'
                                                            action='{{ route('admin.course-documents.destroy', $document->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>                                                 
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-center py-5">No Document Found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="upload-document-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">                
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="mdi mdi-file-document h1 text-info"></i>
                        <h4 class="mt-2">Upload Course Document</h4>
                    </div>
                    <form action="{{ route('admin.course-documents.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12 pb-3">    
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Document Name" required>                                       
                            </div>
                            <div class="col-lg-12">                                
                                <div class="input-group">
                                    <input id="document" type="file"
                                        class="form-control @error('document') is-invalid @enderror" name="document" required>                                    
                                </div>
                                @error('document')
                                    <small id="document-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-info my-2">Upload</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function confirmDelete(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete document!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
@endpush
