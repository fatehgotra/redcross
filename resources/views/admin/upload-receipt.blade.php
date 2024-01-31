@extends('layouts.admin')
@section('title', 'Upload Receipts')
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
                        <li class="breadcrumb-item active">Upload Receipts</li>
                    </ol>
                </div>
                <h4 class="page-title">Upload Receipts</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('admin.add-receipt') }}" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <label for="title" class="form-label">Add receipt csv<span class="text-warning"><a href="{{ ('../../receipt.csv') }}" download> ( download format )</a></span></label>
                            <input 
                            type="file"
                            name="receipts"
                            class="form-control"
                            >
                        </div>
                        <div class="col-md-6 mt-3">
                            <button type="submit" class="form-control btn btn-info"> Upload </button>
                        </div>
                    </div>
                </div>
            </div>
</form>
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

        $('#cndn').change(function() {
            let val = $(this).val();
            if (val == "pending" || val == "approved" || val == "declined" || val == "active" || val == "inactive") {
                $('#based_condition').removeAttr('disabled');

            } else if (val == 'na') {
                $('input[name="values"]').val('');

            } else {
                $('#based_condition').val('');
                $('#based_condition').attr('disabled', true);
            }

        });

        // $('#based_condition').change(function() {
        //     let bv = $(this).val();
        //     if (bv == 'na') {
        //         $('input[name="values"]').val('');
        //     }
        // });

        // $('#values').on('keyup', function() {
        //    let bval =  $('#based_condition').val();

        //    if(bval == "na"){

        //    }
        // });

        $('.gbtn').click(function(e) {
            e.preventDefault();

            let type = $('select[name="type"]').val();
            let cndn = $('select[name="condition"]').val();
            let values = $('input[name="values"]').val();
            let based = $('#based_condition').val();

            if (type == "") {
                alert("Please select type");
                return;
            }

            if (cndn == "") {
                alert("Please select based on");
                return;
            }
            if (cndn == "na") {
                values=""
                
            }

            if ((cndn == "location" || cndn == "expertise" || cndn == "gender" || cndn == "branch") && values == "") {
                alert("Fill values in this case if multiple seprate by a comma(,)");
                return;
            }
            if (cndn == "pending" || cndn == "approved" || cndn == "declined" || cndn == "active" || cndn == "inactive") {
                if (based == "") {
                    alert('Please select something in based on condition');
                    return;
                } else if (based != 'na' && values == "") {

                    alert('Need to add value(s) in this case');
                    return;
                } else if (based == 'na') {

                    values = "";
                }


            } else {
                $('#based_condition').attr('disabled', true);
            }

            let data = {
                _token: "{{ csrf_token() }}",
                type,
                cndn,
                based,
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