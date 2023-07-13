@extends('layouts.user')
@section('title', 'Campaigns')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>                           
                            <li class="breadcrumb-item active">Campaigns</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Campaigns</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card bg-info">
                    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($campaigns as $campaign)
                            <div class="col-md-12">
                                <div class="card border-warning border">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288" />
                                                  </svg> <span class="card-title ms-1 h5">{{ $campaign->title }}</span>                
                                            </div>
                                            <div class="col-6 text-end">
                                                @if(in_array($campaign->id, $user_campaigns))
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger text-white me-1" onclick="confirmExit()"><i class="dripicons-exit me-1"></i>Leave</a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success text-dark"><i class="dripicons-checkmark me-1"></i>Joined</a>
                                                <form id='leave-form' action='{{ route('leave.campaign', $campaign->id) }}'
                                                    method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='_method' value='PUT'>
                                                </form>
                                                @else
                                                <a href="javascript:void(0)" onclick="confirmJoin()" class="btn btn-sm btn-warning text-dark"><i class="dripicons-enter me-1"></i>Join Campaign</a>
                                                    <form id='join-form' action='{{ route('join.campaign', $campaign->id) }}'
                                                        method='POST'>
                                                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                        <input type='hidden' name='_method' value='PUT'>
                                                    </form>
                                                    @endif
                                            </div>
                                           
                                        </div>
                                                                                                                                       
                                    </div>
                                    <div class="card-body">   
                                        {!! $campaign->description !!}                                           
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="badge badge-outline-success text-center">Starts On: <br>{{ \Carbon\Carbon::parse($campaign->starts_at)->format('M d, Y') }}</span>                                                                        
                                            </div>
                                            <div class="col-6 text-end">                                               
                                                <span class="badge badge-outline-danger text-center">Ends On: <br>{{ \Carbon\Carbon::parse($campaign->ends_at)->format('M d, Y') }}</span>                                                                                                                                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                {{ $campaigns->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>   
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmJoin() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to join this campaign!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Join Campaign!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('join-form').submit();
                }
            })
        };
    </script>

<script type="text/javascript">
    function confirmExit() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to leave this campaign!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Leave Campaign!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('leave-form').submit();
            }
        })
    };
</script>
@endpush