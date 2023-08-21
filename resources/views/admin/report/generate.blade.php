@extends('layouts.admin')
@section('title', 'Generate Report')
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
                        <li class="breadcrumb-item active">Generate Report</li>
                    </ol>
                </div>
                <h4 class="page-title">Generate Report</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <label for="title" class="form-label">Type<span class="text-danger">*</span></label>
                            <select class="form-control" name="type">
                                <option value=""> -- Select users type-- </option>
                                <option value="all"> All </option>
                                <option value="volunteer"> Volunteers </option>
                                <option value="volboth"> Volunteer + Both </option>
                                <option value="memboth"> Members + Both </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="title" class="form-label">Based on </label>
                            <select class="form-control" name="condition">
                                <option value=""> -- Based on -- </option>
                                <option value="na"> Not required </option>
                                <option value="location"> Location </option>
                                <option value="gender"> Gender </option>
                                <option value="expertise"> Expertise </option>
                                <option value="branch"> Branch </option>
                                <option value="pending"> Pending </option>
                                <option value="approved"> Approved </option>
                                <option value="declined"> Declined </option>
                                <option value="active"> Active </option>
                                <option value="inactive"> Inactive </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="title" class="form-label">Values <span class="text-danger">*</span>
                                <small>multiples seprated (,)</small>
                            </label>
                            <input type="text" name="values" class="form-control" placeholder="Add values">
                        </div>

                        <div class="col-md-3 mt-3">
                            <button class="form-control btn btn-info gbtn"> Generate </button>
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

<script>
    jQuery(document).ready(function($) {
        $('.gbtn').click(function(e) {
            e.preventDefault();

            let type = $('select[name="type"]').val();
            let cndn = $('select[name="condition"]').val();
            let values = $('input[name="values"]').val();

            if (type == "") {
                alert("Please select type");
                return;
            }

            if (cndn == "") {
                alert("Please select based on");
                return;
            }

            if ((cndn == "location" || cndn == "expertise" || cndn == "gender" || cndn == "branch") && values == "") {
                alert("Fill values in this case if multiple seprate by a comma(,)");
                return;
            }
            if (cndn == "pending" || cndn == "approved" || cndn == "declined" || cndn == "active" || cndn == "inactive") {
                values = "";
            }

            let data = {
                _token: "{{ csrf_token() }}",
                type,
                cndn,
                values,
            };

            var url = "{{ route('admin.export-excel') }}?" + $.param(data);

            window.location = url;

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