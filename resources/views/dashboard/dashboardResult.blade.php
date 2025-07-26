<div class="row">
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlock', ['title' => 'Pénzügy', 'title2' => date('Y'), 'values' => $params['stacked']['week']])
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlock', ['title' => 'Pénzügy', 'title2' => date('Y') - 1, 'values' => $params['stacked']['before']])
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlockAll', ['title' => 'Pénzügy', 'title2' => 'Összesen'])
    </div>
</div>

