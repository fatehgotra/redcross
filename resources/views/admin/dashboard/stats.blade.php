<div class="row">
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="dripicons-shopping-bag widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Sales">Total Volunteers</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\User::count() }} </h3>
                <p class="mb-0 text-muted">                   
                    <span class="text-primary me-2"><span class="mdi mdi-arrow-up-bold"></span> 25 %</span>
                    <span class="text-nowrap">Since Yesterday</span>                   
                </p>     
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="uil-layer-group widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Products">Active Volunteers</h5>
                <h3 class="mt-2 mb-2">34</h3>
                <p class="mb-0 text-muted">
                    <span class="text-success me-1"> Since Yesterday</span>
                </p>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Approved Suppliers">Inactive Volunteers</h5>
                <h3 class="mt-2 mb-2">35</h3>
                <p class="mb-0">
                    <span class="text-warning me-1">Last added: Yesterday</span>
                </p>
            </div>
        </div>
    </div> <!-- end col-->
</div>

