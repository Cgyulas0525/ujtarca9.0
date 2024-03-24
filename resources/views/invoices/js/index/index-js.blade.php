@section('scripts')
    @include('functions.ajax_js')
    @include('functions.currencyFormatDE')
    @include('invoices.js.index.filterBtnTopClick-js')
    @include('invoices.js.index.table-js')
    @include('invoices.js.index.referredBtnClick-js')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            var table = setTable();
            filterBtnTopClick(table);
            referredBtnClick(table);
        });
    </script>
@endsection
