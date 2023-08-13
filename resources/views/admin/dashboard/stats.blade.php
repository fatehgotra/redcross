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
<!------Gender--------->

<div class="row">
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Sales">Male</h5>
                <h3 class="mt-2 mb-2">{{ $male }} </h3>
               
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Products">Female</h5>
                <h3 class="mt-2 mb-2">{{ $female }}</h3>
              
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Approved Suppliers">Non Binary</h5>
                <h3 class="mt-2 mb-2">{{ $non }}</h3>
              
            </div>
        </div>
    </div> <!-- end col-->
</div>


<!-------Month user Charts------->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<div class="container1">
    <div class="row justify-content-cen1ter">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ $month_user_chart->options['chart_title'] }}</div>

                <div class="card-body">
                    {!! $month_user_chart->renderHtml() !!}

                </div>

            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Users by status</div>
                <div id="piechart-volunteer" sty1le="width: 500px; height: 200px;"></div>
                <div id="piechart-member" style1="width: 500px; height: 200px;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Volunteer by Branch</div>
                <div class="card-body">
                <div id="chart-volunteer-branch" style1="width: 550px; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Member by Branch</div>
                <div class="card-body">
                <div id="chart-member-branch" style1="width: 550px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="card">
                <div class="card-header">Volunteer expertise</div>
                <div class="card-body">
                <div id="chart-volunteer-expertise" style1="width: 550px; height: 400px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
        <div class="card">
                <div class="card-header">Member expertise</div>
                <div class="card-body">
                <div id="chart-member-expertise" style1="width: 550px; height: 400px;"></div>
                </div>
            </div>
        </div>
     
    </div>
</div>

@push('scripts')
{!! $month_user_chart->renderChartJsLibrary() !!}
{!! $month_user_chart->renderJs() !!}



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
      google.charts.load('current', {
        'packages': ['corechart','bar']
    });
</script>
  <script type="text/javascript">
  
    google.charts.setOnLoadCallback(drawChartVolunteerStatus);

    function drawChartVolunteerStatus() {

        var data = google.visualization.arrayToDataTable([
            ['Volunteers', 'status Count'],
            @php
            foreach($volunteer_status_data as $k => $d) {
                echo "['".$k."', ".$d."],";
            }
            @endphp
        ]);

        var options = {
            title: 'Volunteers',
            is3D: false,
             chartArea: {width: "94%", height: "80%"}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart-volunteer'));

        chart.draw(data, options);
    }
</script> 

 <script type="text/javascript">
    google.charts.setOnLoadCallback(drawChartMemberStatus);

    function drawChartMemberStatus() {

        var data = google.visualization.arrayToDataTable([
            ['Members', 'status Count'],

            @php
            foreach($members_status_data as $k => $d) {
                echo "['".$k."', ".$d."],";
            }
            @endphp
        ]);

        var options = {
            title: 'Members',
            is3D: false,
            chartArea: {width: "94%", height: "80%"},
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart-member'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChartBranch);

    function drawChartBranch() {

        var data = google.visualization.arrayToDataTable([
            ['Volunteer', 'Volunteers'],

            @php
            foreach($volunteer_branch as $k => $d) {
                echo "['".$d['branch']."', ".$d['Users']."],";
            }
            @endphp
        ]);

        var options = {
            title: 'Volunteers',
            is3D: false,
            legend: { position: "none" } 
        };

        var chart = new google.charts.Bar(document.getElementById('chart-volunteer-branch'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChartBranchMember);

    function drawChartBranchMember() {

        var data = google.visualization.arrayToDataTable([
            ['Member', 'Members'],

            @php
            foreach($member_branch as $k => $d) {
                echo "['".$d['branch']."', ".$d['Users']."],";
            }
            @endphp
        ]);

        var options = {
            title: 'Members',
            is3D: false,
            legend: { position: "none" } 
        };

        var chart = new google.charts.Bar(document.getElementById('chart-member-branch'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChartVexpert);

    function drawChartVexpert() {

        var data = google.visualization.arrayToDataTable([
            ['Volunteer', 'Volunteer'],

            @php
            foreach($volunteer_expertise_chart as $k => $d) {
                echo "['".$k."', ".count($d)."],";
            }
            @endphp
        ]);

        var options = {
            title: '',
            is3D: false,
            pieHole: 0.4,
            chartArea: {width: "94%", height: "80%"} 
        };

        var chart =  new google.visualization.PieChart(document.getElementById('chart-volunteer-expertise'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChartMexpert);

    function drawChartMexpert() {

        var data = google.visualization.arrayToDataTable([
            ['Volunteer', 'Volunteer'],

            @php
            foreach($member_expertise_chart as $k => $d) {
                echo "['".$k."', ".count($d)."],";
            }
            @endphp
        ]);

        var options = {
            title: '',
            is3D: false,
            pieHole: 0.4,
            chartArea: {width: "94%", height: "80%"} 
        };

        var chart =  new google.visualization.PieChart(document.getElementById('chart-member-expertise'));

        chart.draw(data, options);
    }
</script>

@endpush