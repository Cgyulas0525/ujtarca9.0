<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Dátum</span>
                <span class="info-box-number">{{ date('Y.m.d', strtotime(\Carbon\Carbon::now())) }} {{ App\Services\HungarianDateName::getDayName(now()) }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-tag"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Napi bevétel</span>
                <span class="info-box-number">{{ number_format($params['closure']['dailySum'],0,",",".") }} Ft.</span>
            </div>
            <a href="{{ route('closures.edit', App\Models\Closures::max('id')) }}" class="small-box-footer">Utolsó zárás <i class="fas fa-arrow-circle-right"></i></a>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="far fa-heart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">3 hónap  átlaga</span>
                <span class="info-box-number">{{ number_format($params['closure']['averageDailySumMonth'],0,",",".") }} Ft.</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="far fa-comment"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Átlag</span>
                <span class="info-box-number">{{ number_format($params['closure']['averageDailySum'],0,",",".") }} Ft.</span>
            </div>
        </div>
    </div>
</div>
