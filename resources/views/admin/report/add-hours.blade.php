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
            //window.location = url;

            /*   $.ajax({

                   url: "{{ route('admin.export-excel') }}",
                   dataType: "JSON",
                   type: "POST",
                   data: {
                       _token: "{{ csrf_token() }}",
                       type,
                       cndn,
                       values,
                   },
                   success: function(res) {
                       const url = window.URL.createObjectURL(new Blob([res.data]));
                       console.log(url);
                       const link = document.createElement('a');
                       link.setAttribute('download', 'file.pdf');
                       document.body.appendChild(link);
                       link.click();
                   }
               });*/


        });
    });
</script>
@endpush