@extends('app-scaffold.html.app')
@section('content')
    @include('orders.html.create.order-create-header')
    @include('orders.html.create.order-create-content')
@endsection
@section('scripts')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')
    @include('functions.sweetalert_js')
    @include('functions.requiredField')
    @include('functions.ajax_js')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
        });
        RequiredBackgroundModify('.form-control')
    </script>
@endsection
