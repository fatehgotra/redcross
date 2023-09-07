@extends('layouts.admin')
@section('title', 'Add Hours Report')
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
                        <li class="breadcrumb-item active">Add Hours Report</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Hours Report</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="import" action="{{ route('admin.add-hours') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-8">
                                <label for="title" class="form-label"><span class="text-danger"> please make sure you know the format or <a style="color:blue" href="{{ asset('assets/images/format-hours.xlsx') }}" download> download </a> and check it.</span></label>
                                <input type="file" name="report" required class="form-control">
                            </div>

                            <div class="col-md-3 mt-4">
                                <button class="form-control btn btn-info "> Import </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    User Hours
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Branch</th>
                                        <th>Comment</th>
                                        <th>Start Time </th>
                                        <th>End Time </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($users) > 0 )
                                    @foreach ($users as $user)
                                    @if( !is_null($user->user) )
                                    <tr>
                                        <td>{{ $user->user->firstname." ".$user->user->lastname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->date)->format('M d, Y') }}</td>
                                        <td>{{ $user->user->branch}}</td>
                                        <td>{{ $user->comment}}</td>
                                        <td>{{ $user->start_time}}</td>
                                        <td>{{ $user->end_time}}</td>

                                        <td>
                                            <a href="{{ url('/') }}/admin/volunteer/personal-information/{{ $user->user->id }}" target="_blank"><i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="container card p-4">
                <h3 class="card-header text-center">
                    @if( isset($_GET) && isset($_GET['start']) && !is_null($_GET['start']) )
                    {{ 'Search Date : '. $_GET['start'] }}
                    @endif
                </h3>
                <div id='calendar'></div>
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
            "pageLength": 10,
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

        $("#basic-datatable-global").DataTable({
            "paging": true,
            "pageLength": 10,
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

<script>
    jQuery(document).ready(function($) {
        $('.gbtn').click(function(e) {
            e.preventDefault();

            let file = $('input[type="file"]').val();

            if (file == "") {
                alert("Please select file");
                return;
            }


            let data = {
                file: $('input[type="file"]')
            };

            var url = "{{ route('admin.add-hours') }}?" + $.param(data);
            $('#import').submit();


        });

        $(function() {
            $('#basic-datatable').DataTable();
            $.noConflict();
            $("[name='action']").bootstrapSwitch();
        });

        $(function() {
            $('#basic-datatable-global').DataTable();
            $.noConflict();
            $("[name='action']").bootstrapSwitch();
        });
    });
</script>



<!----Fullcalender----->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css1" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script>
    $(document).ready(function() {

        var SITEURL = "{{ url('/') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: [],
            displayEventTime: false,
            editable: true,

            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {

                var start = $.fullCalendar.formatDate(start, "DD-MM-Y");
                var end = $.fullCalendar.formatDate(end, "DD-MM-YY");
                window.history.pushState('page', 'Add Hour Report', '?start=' + start);
                window.location.reload(true);

            },

            eventClick: function(event) {

                window.history.pushState('page', 'Add Hour Report', '?event=' + event.id + '&type=' + ((event.type == 'campaign') ? 'global' : 'community'));
                window.location.reload(true);


            }

        });

    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
</script>
@endpush