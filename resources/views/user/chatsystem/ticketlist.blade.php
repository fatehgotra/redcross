@extends('layouts.user')
@section('title', 'Chat Tickets')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ol>
                </div>
                <h4 class="page-title">Chat Ticket List</h4>
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
                            <a href="{{ route('chat') }}" class="btn btn-sm btn-dark float-end">Add
                                Chat Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Enquiry Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($tickets))
                                    @foreach ($tickets as $p)
                                    <tr>
                                        <td>#{{ $p->id }}</td>
                                        <td>{{ $p->enquiry_type }}</td>

                                        <td>
                                            @if($p->status == 1)
                                            <span class="badge badge-outline-warning"> Open </span>
                                            @else
                                            <span class="badge badge-outline-success"> Closed </span>
                                            @endif

                                        </td>
                                       
                                        <td>
                                            @if($p->status == 1)
                                            <a href="{{ url('/') }}/user/chat-view-ticket/{{ base64_encode($p->id) }}/{{ base64_encode($p->created_by) }}" class="mdi mdi-eye-circle-outline" style="font-size:27px;cursor:pointer"></span>
                                                @else
                                                <span class="text-success"> Closed </span>
                                                @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>No Recent Ticket </td>
                                    </tr>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjzrBuBZeqiQaUzI7EJxZwtQEYFfkBnhs&li&callback=initAutocomplete&libraries=places&v=weekly" async defer></script>

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

@endpush