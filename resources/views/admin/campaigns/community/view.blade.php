@extends('layouts.admin')
@section('title', 'View Community Activitiy')
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
                        <li class="breadcrumb-item active">View Community Activitiy</li>
                    </ol>
                </div>
                <h4 class="page-title">View Community Activitiy</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header"> Activity </h5>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <b>Name </b>
                            <p> {{ $activity->name }} </p>
                        </div>

                        <div class="col-md-4">
                            <b>Starts At</b>
                            <p> {{ \Carbon\Carbon::parse($activity->starts_at)->format('M d,Y') }} </p>
                        </div>
                        <div class="col-md-4">
                            <b>Ends At</b>
                            <p> {{ \Carbon\Carbon::parse($activity->ends_at)->format('M d,Y') }} </p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <b>Submitted By </b>
                            <p> {{ $activity->submitBy->name }} </p>
                        </div>
                        <div class="col-md-4">
                            <b>Submitted To </b>
                            <p> {{ $activity->submitTo->name }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <b>Breif </b>
                            <p> {!! $activity->breif !!} </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header"> Images </h5>

                        <div class="card-body">

                            @if( isset($activity->docs) )
                            @foreach( $activity->docs as $acd )
                            @if( $acd->type == 'image' )
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ $acd->doc }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><a href="{{ asset('storage/uploads/community').'/'.$acd->doc }}" target="_blank" class=" btn btn-info"><i class="mdi mdi-eye"></i></a></p>
                                </div>
                                <div class="col-md-4">
                                    <p><a href="{{ asset('storage/uploads/community').'/'.$acd->doc }}" download class=" btn btn-secondary"><i class="mdi mdi-download"></i></a></p>
                                </div>
                            </div>

                            @endif
                            @endforeach
                            @endif


                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header"> Documents </h5>
                        <div class="card-body">

                            @if( isset($activity->docs) )
                            @foreach( $activity->docs as $acd )
                            @if( $acd->type == 'doc' )
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ $acd->doc }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><a href="{{ asset('storage/uploads/community').'/'.$acd->doc }}" target="_blank" class=" btn btn-info"><i class="mdi mdi-eye"></i></a></p>
                                </div>
                                <div class="col-md-4">
                                    <p><a href="{{ asset('storage/uploads/community').'/'.$acd->doc }}" download class=" btn btn-secondary"><i class="mdi mdi-download"></i></a></p>
                                </div>
                            </div>

                            @endif
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header"> Attendees </h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activity->attendees as $attendee)

                                    <tr>
                                        <td>{{ $attendee->user->id }}</td>
                                        <td>{{ $attendee->user->firstname." ".$attendee->user->lastname }}</td>
                                        <td>{{ $attendee->user->email }}</td>
                                        <td>{{ $attendee->user->phone }}</td>
                                        <td>
                                            <a href="{{ route('admin.volunteer-detail.lodge-information.form', $attendee->user->id) }}" class=" btn btn-info"><i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
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
                [0, 'asc']
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