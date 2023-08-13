@extends('layouts.admin')
@section('title', 'Surveys')
@section('head')
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Surveys</li>
                    </ol>
                </div>
                <h4 class="page-title">Surveys</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <a href="{{ route('admin.survey') }}" class="btn btn-sm btn-dark float-end">Add
                                Survey</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name / Title</th>
                                        <th>Action</th>
                                        <th>Send To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( isset( $surveys ) )
                                    @foreach( $surveys as $s)
                                    <td>{{ $s->id }}</td>
                                    <td>{{ $s->name }}</td>
                                    <td>
                                    <a class="btn btn-sm btn-info" href="{{ route('admin.survey-entries',$s->id) }}"><i class="mdi mdi-text-account"></i></a>
                                        <a class="btn btn-sm btn-warning" href="{{ route('admin.view-survey',$s->id) }}"><i class="mdi mdi-eye"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete( {{ $s->id }} )"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                    <form id='delete-form{{ $s->id }}' action='{{ route('admin.survey-delete', $s->id) }}' method='POST'>
                                                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                    </form>
                                    <td>
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('admin.send-survey',     ['to' => 'all', 'id' =>$s->id] ) }}" class="dropdown-item"><i class="mdi mdi-account-edit-outline"></i>
                                                All</a>
                                            <a href="{{ route('admin.send-survey', ['to' => 'all-volunteers', 'id' =>$s->id] ) }}" class="dropdown-item"><i class="mdi mdi-account-edit-outline"></i>
                                                All Volunteers</a>
                                            <a href="{{ route('admin.send-survey', ['to' => 'all-members', 'id' =>$s->id] ) }}"  class="dropdown-item"><i class="mdi mdi-account-edit-outline"></i>
                                                All Members</a>
                                            <a href="{{ route('admin.send-survey', ['to' => 'active-volunteers', 'id' =>$s->id]) }}"  class="dropdown-item"><i class="mdi mdi-account-edit-outline"></i>
                                                Active Volunteers</a>
                                            <a href="{{ route('admin.send-survey',['to'  => 'active-members', 'id' =>$s->id] ) }}"  class="dropdown-item"><i class="mdi mdi-account-edit-outline"></i>
                                                Active Members</a>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Datatables js -->
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


<!-- Datatable Init js -->
<script>
    $(function() {
        $("#basic-datatable").DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "order": [
                [0, 'desc']
            ]
        });
    });
</script>


<script type="text/javascript">
    function confirmDelete(no) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form' + no).submit();
            }
        })
    };
</script>
@endpush