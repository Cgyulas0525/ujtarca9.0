@section('scripts')
{{--    <script src="{{ asset('/js/currencyFormatDE.js') }} " type="text/javascript"></script>--}}
{{--    @include('functions.ajax_js')--}}
    @include('functions.currencyFormatDE')
    @include('functions.ajax_js')
    @include('orders.js.order-details-table-ajax')
    <script type="text/javascript">

        var table;

        $(function () {
            ajaxSetup();
            table = orderDetailsTableAjax();
        });

        function QuantityChange(Row, value) {
            var d = table.row(Row).data();
            if ( d.value != value ) {
                d.value = value;
                $.ajax({
                    type:"GET",
                    url:"{{url('orderdetailsUpdate')}}",
                    data: { id: d.id, value: value },
                    success: function (response) {
                        table.cell(Row, 3).data(d.value).draw();
                        table.cell(Row, 4).data(response.detailvalue).draw();
                        $('#detailSum').text(response.detailvalue);
                    },
                    error: function (response) {
                        // console.log('Error:', response);
                        alert('nem ok');
                    }
                });
                // table.draw();
                table.row(Row).invalidate();
            }
        }
    </script>
@endsection
