<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 3 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => $arrayQ["revenue"] / $arrayQ["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => $arrayQ["spend"] / $arrayQ["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => $arrayQ["result"] / $arrayQ["number"]])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-calendar-minus"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 6 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => $arrayH["revenue"] / $arrayH["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => $arrayH["spend"] / $arrayH["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => $arrayH["result"] / $arrayH["number"]])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 9 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => $array3Q["revenue"] / $array3Q["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => $array3Q["spend"] / $array3Q["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => $array3Q["result"] / $array3Q["number"]])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 12 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:',  'value' => $arrayY["revenue"] / $arrayY["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:',   'value' => $arrayY["spend"] / $arrayY["number"]])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => $arrayY["result"] / $arrayY["number"]])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
