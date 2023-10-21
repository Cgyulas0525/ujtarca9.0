@extends('layouts.appblack')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        @include('businessanalysis.baHeader')
        @include('businessanalysis.baRevenuePercent')
        @include('businessanalysis.baHighestSuppliers')

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

