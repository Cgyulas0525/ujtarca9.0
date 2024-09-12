@extends('app-scaffold.html.app')

@section('css')
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/Highcharts.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <div class="content">
        @include('dashboard.dashboardHeader')
        @include('dashboard.dashboardInfo', ['params' => $params])
        @include('dashboard.dashboardPeriodAverage', [
            'paramsQ' => $params['weekPeriod']['13'],
            'paramsH' => $params['weekPeriod']['26'],
            'params3Q' => $params['weekPeriod']['39'],
            'paramsY' => $params['weekPeriod']['52']
        ])
        @include('dashboard.dashboardView', ['params' => $params])
        @include('dashboard.dashboardFinance', ['yearstacked' => $params['stacked']['first']])
        @include('dashboard.dashboardResult')
    </div>
@endsection

@section('scripts')
    @include('layouts.RowCallBack_js')
    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

        });
    </script>
@endsection

