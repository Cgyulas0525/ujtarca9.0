@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        @include('dashboard.dashboardHeader')
        @include('dashboard.dashboardInfo')
        @include('dashboard.dashboardPeriodAverage', ['arrayQ' => App\Services\Stacked\PeriodAverageService::weekPeriodResultAverage(13, Carbon\Carbon::now()->weekOfMonth),
                                                      'arrayH' => App\Services\Stacked\PeriodAverageService::weekPeriodResultAverage(26, Carbon\Carbon::now()->weekOfMonth),
                                                      'array3Q' => App\Services\Stacked\PeriodAverageService::weekPeriodResultAverage(39, Carbon\Carbon::now()->weekOfMonth),
                                                      'arrayY' => App\Services\Stacked\PeriodAverageService::weekPeriodResultAverage(52, Carbon\Carbon::now()->weekOfMonth)])
        @include('dashboard.dashboardView')
        @include('dashboard.dashboardFinance', ['yearctacked' => App\Models\Yearstacked::where('year', date('Y'))->first()])
        @include('dashboard.dashboardResult')
    </div>
@endsection

@section('scripts')
    @include('layouts.RowCallBack_js')
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

        });
    </script>
@endsection

