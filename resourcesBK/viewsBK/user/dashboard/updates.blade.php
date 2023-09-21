<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Updates</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($updates as $update)
                    <div class="col-md-12">
                        <div class="card border-warning border">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                          </svg> <span class="card-title ms-1 h5">{{ $update->title }}</span>                
                                    </div>
                                   
                                </div>
                                                                                                                               
                            </div>
                            <div class="card-body">   
                                {!! $update->content !!}                                           
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="badge badge-outline-dark">Published On: {{ \Carbon\Carbon::parse($update->created_at)->format('M d, Y h:i A') }}</span>                                                                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-md-12">
                            <p class="text-center py-5">No Update found</p>
                        </div>
                    @endforelse
                </div>
            </div>
            @if(\App\Models\Blog::where('status', true)->count() > 5)
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('updates.index') }}" class="btn btn-sm text-dark btn-warning">View All</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>