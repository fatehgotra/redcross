<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Alerts</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($alerts as $alert)
                    <div class="col-md-12">
                        <div class="card border-dark border">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                          </svg> <span class="card-title ms-1 h5">{{ $alert->title }}</span>                
                                    </div>
                                   
                                </div>
                                                                                                                               
                            </div>
                            <div class="card-body">   
                                {!! $alert->description !!}                                           
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="badge badge-outline-dark">Published On: {{ \Carbon\Carbon::parse($alert->created_at)->format('M d, Y h:i A') }}</span>
                                        @if($alert->priority == "Low")
                                            <span class="badge badge-outline-secondary">Severity : Low</span>
                                        @elseif ($alert->priority == "Medium")
                                            <span class="badge badge-outline-info">Severity : Medium</span>
                                        @else
                                            <span class="badge badge-outline-danger">Severity : High</span>
                                        @endif                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-md-12">
                            <p class="text-center py-5">No Alert found</p>
                        </div>
                    @endforelse
                </div>
            </div>
            @if(\App\Models\Alert::where('status', true)->count() > 5)
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('alerts.index') }}" class="btn btn-sm text-dark btn-warning">View All</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>