@section('scripts')
    @include('functions.ajax_js')
    @include('functions.cookiesFunctions_js')
    @include('orders.js.index.table-js')
    @include('orders.js.index.load-url')
    @include('orders.js.index.order-type-change')
    @include('orders.js.index.order-status-change')
    <script type="text/javascript">
        var table;
        $(function () {
            ajaxSetup();
            table = indexTable();
            orderTypeChange(table);
            orderStatusChange(table);
        });
    </script>
@endsection
