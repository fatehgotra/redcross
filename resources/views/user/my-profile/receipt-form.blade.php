@extends('layouts.user')
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
        @include('user.includes.flash-message')
        <div class="row">
            
            <div class="col-sm-3">
                <div class="card">
                <div class="card-body p-0">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link" href="{{ route('my-profile.lodge-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Lodgement Information
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.personal-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Personal Information
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.contact-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Contact Information
                                </a>
                                <a class="nav-link"
                                    href="{{ route('my-profile.identification-and-employement-details.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Identification Details
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.education-background.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Education Background
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.special-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Special Information
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.service-interest.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Service Interests
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.banking-information.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Banking Information
                                </a>
                                <a class="nav-link" href="{{ route('my-profile.consents-and-checks.form') }}">
                                    <i class="me-1 dripicons-chevron-right"></i>Consent and Checks
                                </a>
                                <a class="nav-link active show" href="{{ route('my-profile.receipts.form') }}">
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