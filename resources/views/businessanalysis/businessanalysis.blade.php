@extends('layouts.appblack')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <div class="content">
        @include('businessanalysis.baHeader')
        @include('businessanalysis.baRevenuePercent', [
            'monthStacked' => $dataArray['monthStacked'],
            'yearStacked' => $dataArray['yearStacked']
        ])
        @include('businessanalysis.baHighestSuppliers', [
            'bestSuppliers' => $dataArray['bestSuppliers']
        ])
    </div>
@endsection

@section('scripts')
    @include('layouts.RowCallBack_js')
    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

        });
    </script>
@endsection

