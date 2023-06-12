<div class="row">
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
                                    <small class="text-muted">{{ Auth::user()->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    @endforelse
                    <div class="timeline-item">
                        <i class="mdi mdi-information-variant bg-success-lighten text-succes timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="#" class="text-info fw-bold mb-1 d-block">Your Application submitted
                                successfully & is under review.</a>
                            <p class="mb-0 pb-2">
                                <small class="text-muted">{{ Auth::user()->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        @if(Auth::user()->status == "approve" && Auth::user()->approved_by == "HQ")
        <div class="card cta-box bg-success text-white py-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="w-100 overflow-hidden">
                        <h2 class="mt-0">Application Status</h2>
                        <h3 class="m-0 fw-normal cta-box-title"><b><i class="mdi mdi-bullhorn-outline"></i> Approved</b></h3>
                    </div>
                    <img class="ms-3" src="assets/images/email-campaign.png" width="140" alt="Generic placeholder image">
                </div>
            </div>
            <!-- end card-body -->
        </div>
        @elseif(Auth::user()->status == "decline")
        <div class="card cta-box bg-danger text-white py-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="w-100 overflow-hidden">
                        <h2 class="mt-0">Application Status</h2>
                        <h3 class="m-0 fw-normal cta-box-title"><b><i class="mdi mdi-bullhorn-outline"></i> Declined</b></h3>
                    </div>
                    <img class="ms-3" src="assets/images/email-campaign.png" width="140" alt="Generic placeholder image">
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
                    <img class="ms-3" src="assets/images/email-campaign.png" width="140" alt="Generic placeholder image">
                </div>
            </div>
            <!-- end card-body -->
        </div>
        @endif
        <!-- end card-->       

    </div>
    @isset(Auth::user()->decline_reason)
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                       <h4 class="card-title"> Decline Reason</h4>
                    </div>
                    <div class="card-body">
                        <p> {{ Auth::user()->decline_reason }}</p>
                     </div>
                </div>
            </div>
            @endisset
</div>

