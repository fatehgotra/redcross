@extends('layouts.admin')
@section('title', "Member | Approval History")
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
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.members.index') }}">Members</a></li>
                            <li class="breadcrumb-item active">Approval History</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><i class="uil-home-alt"></i> Approval History</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <p><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>  
                        </div>
                        <div class="float-end">
                            <p class="text-danger"><strong>Registration No: {{ $user->id }}</strong></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Track Application Status</h4>
                        <div class="timeline-alt pb-0">
                            @forelse ($approval_history as $history)
                                <div class="timeline-item">
                                    @if($history->status == 'approve')
                                    <i class="mdi mdi-check bg-success-lighten text-succes timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <a href="#"
                                            class="text-info fw-bold mb-1 d-block">Approved
                                            By {{ $history->approved_by }}</a>
                                        <p class="mb-0 pb-2">
                                            <small class="text-muted">{{ $history->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                    @elseif($history->status == 'decline')
                                    <i class="mdi mdi-window-close bg-danger-lighten text-danger timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <a href="#"
                                            class="text-info fw-bold mb-1 d-block">Declined
                                            By {{ $history->approved_by }}</a>
                                        <p class="mb-0 pb-2">
                                            <small class="text-muted">{{ $history->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                    @elseif($history->status == 'pending')
                                    <i class="mdi mdi-spin mdi-clock-outline bg-info-lighten text-info timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <a href="#"
                                            class="text-info fw-bold mb-1 d-block">Pending Approval
                                            from {{ $history->approved_by }}</a>
                                        <p class="mb-0 pb-2">
                                            <small class="text-muted">{{ $history->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                    @else
                                    <i class="mdi mdi-spin mdi-clock-outline bg-info-lighten text-info timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <a href="#"
                                            class="text-info fw-bold mb-1 d-block">{{ $history->status == 'approve' ? 'Approved' : 'Declined' }}
                                            By {{ $history->approved_by }}</a>
                                        <p class="mb-0 pb-2">
                                            <small class="text-muted">{{ $history->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                    @endif                            
                                </div>
                            @empty
                                <div class="timeline-item">
                                    <i class="mdi mdi-spin mdi-clock-outline bg-success-lighten text-succes timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <a href="#" class="text-info fw-bold mb-1 d-block">Pending Approval from Branch
                                            Level.</a>
                                        <p class="mb-0 pb-2">
                                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                            @endforelse
                            <div class="timeline-item">
                                <i class="mdi mdi-information-variant bg-success-lighten text-succes timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="#" class="text-info fw-bold mb-1 d-block">Member Application submitted
                                        successfully & is under review.</a>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                @if($user->status == "approve" && $user->approved_by == "HQ")
                <div class="card cta-box bg-success text-white py-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100 overflow-hidden">
                                <h2 class="mt-0">Application Status</h2>
                                <h3 class="m-0 fw-normal cta-box-title"><b><i class="mdi mdi-bullhorn-outline"></i> Approved</b></h3>
                            </div>
                            <img class="ms-3" src="{{ asset('assets/images/email-campaign.png') }}" width="140" alt="Generic placeholder image">
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                @elseif($user->status == "decline")
                <div class="card cta-box bg-danger text-white py-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100 overflow-hidden">
                                <h2 class="mt-0">Application Status</h2>
                                <h3 class="m-0 fw-normal cta-box-title"><b><i class="mdi mdi-bullhorn-outline"></i> Declined</b></h3>
                            </div>
                            <img class="ms-3" src="{{ asset('assets/images/email-campaign.png') }}" width="140" alt="Generic placeholder image">
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                @else
                <div class="card cta-box bg-danger text-white py-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100 overflow-hidden">
                                <h2 class="mt-0">Application Status</h2>
                                <h3 class="m-0 fw-normal cta-box-title"><b><i class="mdi mdi-bullhorn-outline"></i> Pending for Review</b></h3>
                            </div>
                            <img class="ms-3" src="{{ asset('assets/images/email-campaign.png') }}" width="140" alt="Generic placeholder image">
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                @endif
                <!-- end card-->       
        
            </div>
            @isset($user->decline_reason)
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                       <h4 class="card-title"> Decline Reason</h4>
                    </div>
                    <div class="card-body">
                        <p> {{ $user->decline_reason }}</p>
                     </div>
                </div>
            </div>
            @endisset
        </div>        
    </div>
@endsection