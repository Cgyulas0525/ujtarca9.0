<div class="row">
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlock', ['title' => 'Pénzügy', 'title2' => date('Y')])
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlockOneYear', ['title' => 'Pénzügy', 'title2' => date('Y') - 1])
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlockAll', ['title' => 'Pénzügy', 'title2' => 'Összesen'])
    </div>
</div>

