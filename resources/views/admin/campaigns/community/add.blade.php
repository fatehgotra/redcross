@extends('layouts.admin')
@section('title', 'Add Community Activity')
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Add Community Activity</a></li>
                        <li class="breadcrumb-item active">Add Community Activity</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Community Activity</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

    @php
    $users = \App\Models\User::WhereIn('role',['both','volunteer','member'])->get();
    @endphp

</div> <!-- container -->
<form method="POST" action="{{ route('admin.community-store') }}" id="supplierForm" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3>Activity Details</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="title" class="form-label">Activity Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required name="name" id="name" placeholder="Activity Name" value="{{ old('name') }}">
                            @error('name')
                            <code id="title-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description" class="form-label">Activity Breif <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="breif" id="breif" rows="10" placeholder="description">{{ old('breif') }}</textarea>
                            @error('breif')
                            <code id="description-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                     
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Submit To Division Officer<span class="text-danger">*</span></label>
                            <select id="available_days" required class="form-select select2 @error('submit_to') is-invalid @enderror" name="submit_to[]" required data-toggle="select2" data-placeholder="Select Branch Officer">

                                <option value="">--Select Division Officer --</option>
                                @if( count($admins) > 0 )
                                @foreach( $admins as $adm)

                                @php
                                $b = "<b>".( ( !is_null($adm->branch) ) ? " | ".implode(' , ',(array)$adm->branch) : '' )."</b>";
                                @endphp
                                <option value="{{ $adm->id }}">{{ $adm->name }} {!! $b !!}</option>

                                @endforeach
                                @endif

                            </select>
                            @error('submit_to')
                            <code id="description-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="entry_closed" class="form-label"> Attendees <span class="text-danger">*</span></label>
                            <select id="available_days" class="form-select select2 @error('available_days') is-invalid @enderror" name="attendees[]" required data-toggle="select2" data-placeholder="Select Attendees" multiple>
                                <option value="">Select Attendees</option>

                                @if( count($users) > 0 )
                                @foreach( $users as $usr)
                                <option value="{{ $usr->id }}">{{ $usr->firstname." ".$usr->lastname }}</option>
                                @endforeach
                                @endif

                            </select>
                            @error('attendees')
                            <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2 imr">
                            <label for="ends_at" class="form-label">Images <span class="text-danger"> ( jpg , jpeg, png )</span></label>
                            <input name="image[0][file]" class="form-control mb-2" type="file">

                        </div>

                        <div class="col-md-6 mb-2 dor">
                            <label for="ends_at" class="form-label">Documents <span class="text-danger">( pdf )</span></label>
                            <input name="doc[0][file]" class="form-control mb-2" type="file">

                        </div>

                        <div class="col-md-6 mb-2 ">
                            <button class="btn btn-success adimg" type="button">+</button>

                        </div>

                        <div class="col-md-6 mb-2">
                            <button class="btn btn-success addoc" type="button">+</button>

                        </div>

                        <div class="col-md-12 mb-2 text-end">
                            <button type="submit" class="btn btn-sm btn-warning" form="supplierForm">Save</button>
                            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-dark">Cancel</a>
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
        selector: 'textarea#breif',
        height: 300,
        menubar: false,
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help ',

    });
</script>
<script>
    jQuery(document).ready(function($) {
        let i = 1,
            j = 1;
        $('.adimg').click(function(e) {
            let im = '<input name="image[' + i + '][file]" class="form-control mb-2" type="file">';
            $('.imr').append(im);
            i++;
        });

        $('.addoc').click(function(e) {
            let im = '<input name="doc[' + j + '][file]" class="form-control mb-2" type="file">';
            $('.dor').append(im);
            j++;
        });
    });
</script>
@endpush