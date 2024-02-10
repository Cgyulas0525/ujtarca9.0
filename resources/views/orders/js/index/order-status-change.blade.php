<script type="text/javascript">
    function orderStatusChange(table) {
        $('#orderStatus').change(function () {
            let url = '{{ route('ordersIndex', [":orderType", ":orderStatus"]) }}';
            createCookie('orderStatus', $('#orderStatus').val(), '90');
            loadUrl(url, table);
        })
    }
</script>
