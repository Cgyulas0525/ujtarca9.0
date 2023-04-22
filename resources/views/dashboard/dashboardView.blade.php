<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-cash-register"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Árbevétel</span>
                @include('dashboard.dasboardViewItem', [ 'title' => 'Heti:', 'value' => App\Models\Weekstacked::all()->last()->revenue])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Havi:', 'value' => App\Models\Monthstacked::all()->last()->revenue])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Éves:', 'value' => App\Models\Yearstacked::all()->last()->revenue])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Költség</span>
                @include('dashboard.dasboardViewItem', [ 'title' => 'Heti:', 'value' => App\Models\Weekstacked::all()->last()->spend])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Havi:', 'value' => App\Models\Monthstacked::all()->last()->spend])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Éves:', 'value' => App\Models\Yearstacked::all()->last()->spend])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-poll"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Eredmény</span>
                @include('dashboard.dasboardViewItem', [ 'title' => 'Heti:', 'value' => App\Models\Weekstacked::all()->last()->revenue - App\Models\Weekstacked::all()->last()->spend])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Havi:', 'value' => App\Models\Monthstacked::all()->last()->revenue - App\Models\Monthstacked::all()->last()->spend])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Éves:', 'value' => App\Models\Yearstacked::all()->last()->revenue - App\Models\Yearstacked::all()->last()->spend])
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Átlag</span>
                @include('dashboard.dasboardViewItem', [ 'title' => 'Heti:', 'value' => App\Models\Weekstacked::all()->last()->average])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Havi:', 'value' => App\Models\Monthstacked::all()->last()->average])
                @include('dashboard.dasboardViewItem', [ 'title' => 'Éves:', 'value' => App\Models\Yearstacked::all()->last()->average])
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="info-box mb-12 bg-primary">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>
            <div class="info-box-content text-center">
                <span class="info-box-number h3">Az elmúlt 3 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga: {{ number_format(App\Services\Stacked\PeriodAverageService::weekPeriodResultAverage(13, Carbon\Carbon::now()->weekOfMonth), 0, ",", ".") }} Ft.</span>
            </div>
        </div>
    </div>
</div>
