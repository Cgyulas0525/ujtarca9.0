@extends('layouts.appblack')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <div class="content">
        @include('businessanalysis.baHeader')
        @include('businessanalysis.baHighestSuppliers', [
            'bestSuppliers' => $dataArray['bestSuppliers']
        ])
        @include('businessanalysis.baRevenuePercent', [
            'monthStacked' => $dataArray['monthStacked'],
            'yearStacked' => $dataArray['yearStacked'],
            'reports' => $dataArray['reports'],
        ])
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

