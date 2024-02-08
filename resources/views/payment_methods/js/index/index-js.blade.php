@section('scripts')
    @include('functions.ajax_js')
    @include('payment_methods.js.index.table-js')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            indexTable();
        });
    </script>
@endsection

