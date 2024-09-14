<script type="text/javascript">
    function filterBtnTopClick(table) {
        $('.filterBtnTop').click(function () {
            putSession("invoiceReferred", "No");
            let year = $('#year').val();
            let partner = $('#partner').val();
            let url = '{{ route('invoicesIndex', [":year", ":partner"]) }}';
            url = url.replace(':year', year);
            url = url.replace(':partner', partner);
            table.ajax.url(url).load();
        })
    }
</script>

