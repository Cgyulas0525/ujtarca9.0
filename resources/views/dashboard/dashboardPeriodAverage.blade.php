<div class="col-lg-12 col-md-12 col-xs-12">
    <div class="info-box mb-12 bg-primary">
        <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>
        <div class="info-box-content text-center">
            <span class="info-box-number h3">Az elmúlt 3 hónap {{ Carbon\Carbon::now()->weekOfMonth }}. hétének átlaga: {{ number_format(App\Services\Stacked\PeriodAverageService::weekPeriodResultAverage(13, Carbon\Carbon::now()->weekOfMonth), 0, ",", ".") }} Ft.</span>
        </div>
    </div>
</div>
