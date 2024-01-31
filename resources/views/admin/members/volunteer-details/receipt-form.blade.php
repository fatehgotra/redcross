@extends('layouts.admin')
@section('title', 'Member Details')
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
                            <li class="breadcrumb-item">Member Details</li>
                            <li class="breadcrumb-item active">Receipts</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Member Details</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>
                        </div>
                        @include('admin.members.volunteer-details.section.approval-section')
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.lodge-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.personal-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Personal Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.contact-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Contact Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.identification-and-employement-details.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Identification Details
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.education-background.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Education Background
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.special-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Special Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.service-interest.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Service Interests
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.banking-information.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Banking Information
                            </a>
                            <a class="nav-link"
                                href="{{ route('admin.member-detail.consents-and-checks.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                            </a>
                            <a class="nav-link active show"
                                href="{{ route('admin.member-detail.receipt.form', $user->id) }}">
                                <i class="me-1 dripicons-chevron-right"></i>Receipts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Receipts</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-sm table-bordered" id="qualifications">
                                <thead>
                                    <tr>
                                        <th>Receipt Number</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($receipts) > 0)
                                        @foreach ($receipts as $key => $r)
                                            <tr id="qualification-row0">

                                                <td>{{$r->receipt_no}}</td>
                                                <td><button class="btn btn-info" onclick="viewReceipt('{{ $r->image }}')"><i class="fa fa-eye"></i></button></td>
                                               
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="qualification-row0">
                                            <td colspan="6" class="text-end">
                                                No Receipt added
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-dark float-end">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="receipt-view-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-filled">
            <div class="modal-body p-4">
               <img src="" id="vimg">
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    function viewReceipt(url){
      $('#vimg').attr('src',url);
      $('#receipt-view-modal').modal('show');
    }
</script>
@endpush