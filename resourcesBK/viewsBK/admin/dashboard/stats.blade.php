<div class="row">
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Sales">Total Volunteers</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\User::where('role','volunteer')->count() }} </h3>
               
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Products">Total Members</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\User::where('role','member')->count() }}</h3>
             
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Approved Suppliers">Both</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\User::where('role','both')->count() }}</h3>
               
            </div>
        </div>
    </div> <!-- end col-->
</div>
