@extends('app-scaffold.html.app')
@section('content')
    @include('orders.html.create.order-create-header')
    @include('orders.html.create.order-create-content')
@endsection
@section('scripts')
    @include('functions.required_js')
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
