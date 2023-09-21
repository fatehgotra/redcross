@extends('layouts.admin')
@section('title', 'Add Survey')
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.survey-forms') }}">surveys</a></li>
                        <li class="breadcrumb-item active">Add Survey</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Survey</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->
<form method="POST" action="{{ route('admin.add-survey') }}" id="supplierForm" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3>Add Form</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="title" class="form-label">Name / Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name / Title" value="{{ old('title') }}">
                            @error('name')
                            <code id="title-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="col-lg-12 table-responsive">
                            <table class="table table-sm table-bordered" id="field">
                                <thead>
                                    <tr>
                                        <th>Type <span class="text-danger">*</span> </th>
                                        <th>Required <span class="text-danger">*</span> </th>
                                        <th>Label / Content <span class="text-danger">*</span></th>
                                        <th>Options <span class="text-danger">*</span> <small> For only radio, mutiselect are comma (,) seprated </small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="field-row0">

                                        <td>
                                            <select name="field[0][type]" class="form-select" required>
                                                <option value="">Select</option>
                                                <option value="text">Text</option>
                                                <option value="number">Number</option>
                                                <option value="radio">Radio</option>
                                                <option value="multiselect">Multiselect</option>
                                            </select>

                                        </td>
                                        <td>
                                            <select name="field[0][required]" class="form-select" required>
                                                <option value="">Select</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>

                                        </td>
                                        <td><input type="text" class="form-control" name="field[0][content]" required></td>
                                        <td><input type="text" class="form-control" name="field[0][options]"></td>
                                        <td><button class="btn btn-sm btn-danger" onclick="$('#field-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <button type="button" class="btn btn-sm btn-info" onclick="addField();"><i class="mdi mdi-plus"></i></button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="supplierForm">Save</button>
                                <a href="{{ route('admin.survey-forms') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.9/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#content',
        height: 300,
        menubar: false,
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help ',

    });

    jQuery(document).ready(function($) {
        $('.addbtn').click(function(e) {
            e.preventDefault();

        });
    });
</script>
<script>
 
    var field_row = 1;

    function addField() {

        html = '<tr id="field-row' + field_row + '">';

        html += '<td><select name="field['+field_row+'][type]" class="form-select" required>';
        html +=      '<option value="">Select</option>';
        html +=      '<option value="text">Text</option>';
        html +=      '<option value="number">Number</option>';
        html +=      '<option value="radio">Radio</option>';
        html +=      '<option value="multiselect">Multiselect</option>';
        html +=      '</select>';
        html +=  '</td>';

        html += '<td><select name="field['+field_row+'][required]" class="form-select" required>';
        html +=      '<option value="">Select</option>';
        html +=      '<option value="yes">Yes</option>';
        html +=      '<option value="no">No</option>';
        html +=      '</select>';
        html +=  '</td>';

        html += ' <td><input type="text" class="form-control" name="field['+field_row+'][content]" required></td>';
        html += ' <td><input type="text" class="form-control" name="field['+field_row+'][options]"></td>';
        html += ' <td><button class="btn btn-sm btn-danger" onclick="$(\'#field-row'+field_row+'\').remove();"><i class="mdi mdi-delete"></i></button></td>';

        html += '</tr>';

        $('#field tbody').append(html);

        field_row++;
    }
</script>
@endpush