<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 3 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => ($paramsQ["number"] > 0 ? $paramsQ["revenue"] / $paramsQ["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($paramsQ["number"] > 0 ? $paramsQ["spend"] / $paramsQ["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($paramsQ["number"] > 0 ? $paramsQ["result"] / $paramsQ["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-calendar-minus"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 6 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => ($paramsH["number"] > 0 ? $paramsH["revenue"] / $paramsH["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($paramsH["number"] > 0 ? $paramsH["spend"] / $paramsH["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($paramsH["number"] > 0 ? $paramsH["result"] / $paramsH["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 9 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => ($params3Q["number"] > 0 ? $params3Q["revenue"] / $params3Q["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($params3Q["number"] > 0 ? $params3Q["spend"] / $params3Q["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($params3Q["number"] > 0 ? $params3Q["result"] / $params3Q["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 12 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:',  'value' => ($paramsY["number"] > 0 ? $paramsY["revenue"] / $paramsY["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($paramsY["number"] > 0 ? $paramsY["spend"] / $paramsY["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($paramsY["number"] > 0 ? $paramsY["result"] / $paramsY["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
