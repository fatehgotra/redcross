@php
    $roles = Auth::guard('admin')
        ->user()
        ->getRoleNames()
        ->toArray();
    $hours = \App\Models\UserHours::where('email',$user->email)->first();

@endphp
@if( !is_null($hours) > 0)
<form action="{{ route('admin.export-hours',$user->id) }}" method="POST" >
@csrf
<button type="submit" class="btn btn-sm btn-info float-end ms-1"  type="button"><i
    class="mdi mdi-download"></i>Hours Report</button>
</form>
@endif
@hasanyrole('branch-level|division-manager|hq')

    @if (in_array('hq', $roles))
        <div class="float-end">
            @if ($user->status == 'approve')
                @if ($user->approved_by == 'HQ')
                    <button class="btn btn-sm btn-success" disabled type="button"><i
                            class="me-1 dripicons-checkmark"></i>Approved</button>
                            
                @else
                    <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i
                            class="me-1 dripicons-checkmark"></i>Approve</a>
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal"
                        class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>

                    <form id='approve-form' action="{{ route('admin.change-status', $user->id) }}" method='POST'>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <input type='hidden' name='status' value='approve'>
                        <input type='hidden' name='_method' value='PUT'>
                    </form>
                    
                @endif
            @elseif($user->status == 'decline')
                <button class="btn btn-sm btn-danger" disabled type="button"><i
                        class="me-1 dripicons-cross"></i>Declined</button>
            @else
                <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i
                        class="me-1 dripicons-checkmark"></i>Approve</a>

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal"
                    class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>

                <form id='approve-form' action="{{ route('admin.change-status', $user->id) }}" method='POST'>
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <input type='hidden' name='status' value='approve'>
                    <input type='hidden' name='_method' value='PUT'>
                </form>
            @endif
        </div>
    @elseif(in_array('division-manager', $roles))
        <div class="float-end">
            @if ($user->status == 'approve')
                @if ($user->approved_by == 'Division Manager')
                    <button class="btn btn-sm btn-success" disabled type="button"><i
                            class="me-1 dripicons-checkmark"></i>Approved</button>
                            
                @else
                    <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i
                            class="me-1 dripicons-checkmark"></i>Approve</a>
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal"
                        class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>

                    <form id='approve-form' action="{{ route('admin.change-status', $user->id) }}" method='POST'>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <input type='hidden' name='status' value='approve'>
                        <input type='hidden' name='_method' value='PUT'>
                    </form>
                @endif
            @elseif($user->status == 'decline')
                <button class="btn btn-sm btn-danger" disabled type="button"><i
                        class="me-1 dripicons-cross"></i>Declined</button>
            @else
                <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i
                        class="me-1 dripicons-checkmark"></i>Approve</a>

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal"
                    class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>

                <form id='approve-form' action="{{ route('admin.change-status', $user->id) }}" method='POST'>
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <input type='hidden' name='status' value='approve'>
                    <input type='hidden' name='_method' value='PUT'>
                </form>
            @endif
        </div>
    @elseif(in_array('branch-level', $roles))
        <div class="float-end">
            @if ($user->status == 'approve')
                @if ($user->approved_by == 'Branch Level')
                    <button class="btn btn-sm btn-success" disabled type="button"><i
                            class="me-1 dripicons-checkmark"></i>Approved</button>
                            
                @else
                    <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i
                            class="me-1 dripicons-checkmark"></i>Approve</a>
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal"
                        class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>

                    <form id='approve-form' action="{{ route('admin.change-status', $user->id) }}" method='POST'>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <input type='hidden' name='status' value='approve'>
                        <input type='hidden' name='_method' value='PUT'>
                    </form>
                @endif
            @elseif($user->status == 'decline')
                <button class="btn btn-sm btn-danger" disabled type="button"><i
                        class="me-1 dripicons-cross"></i>Declined</button>
            @else
                <a href="javascript:void(0);" onclick="confirmAccept()" class="btn btn-sm btn-success"><i
                        class="me-1 dripicons-checkmark"></i>Approve</a>
                        

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#decline-alert-modal"
                    class="btn btn-sm btn-danger"><i class="me-1 dripicons-cross"></i>Decline</a>

                <form id='approve-form' action="{{ route('admin.change-status', $user->id) }}" method='POST'>
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <input type='hidden' name='status' value='approve'>
                    <input type='hidden' name='_method' value='PUT'>
                </form>
            @endif
          
        </div>
    @endif
@endhasanyrole


