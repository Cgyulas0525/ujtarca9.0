<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-cash-register"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Árbevétel</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Heti:', 'value' => $params['stacked']['week']->revenue])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Havi:', 'value' => $params['stacked']['month']->revenue])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Éves:', 'value' => $params['stacked']['year']->revenue])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Költség</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Heti:', 'value' => $params['stacked']['week']->spend])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Havi:', 'value' => $params['stacked']['month']->spend])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Éves:', 'value' => $params['stacked']['year']->spend])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-poll"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Eredmény</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Heti:', 'value' => $params['stacked']['week']->revenue - $params['stacked']['week']->spend])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Havi:', 'value' => $params['stacked']['month']->revenue -$params['stacked']['month']->spend])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Éves:', 'value' => $params['stacked']['year']->revenue - $params['stacked']['year']->spend])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Átlag</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Heti:', 'value' => $params['stacked']['week']->average])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Havi:', 'value' => $params['stacked']['month']->average])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Éves:', 'value' => $params['stacked']['year']->average])
            </div>
        </div>
    </div>
</div>
