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

