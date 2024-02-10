<script type="text/javascript">
    function orderTypeChange(table) {
        $('#orderType').change(function () {
            let url = '{{ route('ordersIndex', [":orderType", ":orderStatus"]) }}';
            table.column(3).visible($('#orderType').val() == 'CUSTOMER');
            createCookie('orderType', $('#orderType').val(), '90');
            loadUrl(url, table);
        })
    }
</script>
