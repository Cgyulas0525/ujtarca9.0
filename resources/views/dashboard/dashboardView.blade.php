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
</div>
