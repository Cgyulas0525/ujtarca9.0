<script type="text/javascript">
    function filterBtnTopClick(table) {
        function reloadTable() {
            putSession("invoiceReferred", "No");
            let url = '{{ route('invoicesIndex', [":year", ":partner"]) }}';
            url = url.replace(':year', $('#year').val());
            url = url.replace(':partner', $('#partner').val());
            table.ajax.url(url).load();
        }

        $('#year, #partner').change(reloadTable);
    }
</script>

