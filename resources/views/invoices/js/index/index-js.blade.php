@section('scripts')
    @include('functions.ajax_js')
    @include('functions.currencyFormatDE')
    @include('invoices.js.index.filterBtnTopClick-js')
    @include('invoices.js.index.table-js')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            var table = setTable();
            filterBtnTopClick(table);
        });
    </script>
@endsection
