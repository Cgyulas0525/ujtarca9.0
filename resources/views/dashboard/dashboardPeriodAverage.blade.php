<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 3 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => ($arrayQ["number"] > 0 ? $arrayQ["revenue"] / $arrayQ["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($arrayQ["number"] > 0 ? $arrayQ["spend"] / $arrayQ["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($arrayQ["number"] > 0 ? $arrayQ["result"] / $arrayQ["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-calendar-minus"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 6 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => ($arrayH["number"] > 0 ? $arrayH["revenue"] / $arrayH["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($arrayH["number"] > 0 ? $arrayH["spend"] / $arrayH["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($arrayH["number"] > 0 ? $arrayH["result"] / $arrayH["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 9 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:', 'value' => ($array3Q["number"] > 0 ? $array3Q["revenue"] / $array3Q["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($array3Q["number"] > 0 ? $array3Q["spend"] / $array3Q["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($array3Q["number"] > 0 ? $array3Q["result"] / $array3Q["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Az elmúlt 12 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga:</span>
                @include('dashboard.dashboardViewItem', [ 'title' => 'Bevétel:',  'value' => ($arrayY["number"] > 0 ? $arrayY["revenue"] / $arrayY["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Kiadás:', 'value' => ($arrayY["number"] > 0 ? $arrayY["spend"] / $arrayY["number"] : 0)])
                @include('dashboard.dashboardViewItem', [ 'title' => 'Eredmény:', 'value' => ($arrayY["number"] > 0 ? $arrayY["result"] / $arrayY["number"] : 0)])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
