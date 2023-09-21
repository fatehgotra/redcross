@extends('layouts.admin')
@section('title', 'Survey User Entries')
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
                <h4 class="page-title">Surveys User Entries</h4>
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
                            <h3 class="float-start"> {{ count($survey->entries) > 0 ? $survey->entries[0]->participant->firstname." ".$survey->entries[0]->participant->lastname : '' }}</h3>
                            <a href="{{ route('admin.survey-entries',$survey->id) }}" class="btn btn-sm btn-dark float-end">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Response data</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if( isset( $data ) )
                                    @foreach( $data[0]['questions'] as $k=> $d)
                                    <tr>
                                        <td>{{ $d[0] }}</td>
                                        <td>{{ $data[0]['answers'][$k][0]  }}</td>
                                    </tr>
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