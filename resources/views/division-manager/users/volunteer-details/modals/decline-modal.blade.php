<div id="decline-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <form id='decline-form' action='{{ route('division-manager.change-status', $user->id) }}' method='POST'>
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <input type='hidden' name='status' value='decline'>
                    <input type='hidden' name='_method' value='PUT'>
                    <div class="text-center">
                        <i class="dripicons-warning h1"></i>
                        <h3 class="mt-2">Are you sure?!</h3>
                        <p class="mt-3">You want to decline this Volunteer application form.</p>
                        <label for="reason" class="form-label text-start text-white">Reason for decline</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Write Reason for decline" required></textarea>
                        <button type="submit" class="btn btn-light my-2" form="decline-form">Yes, Decline
                            It!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
