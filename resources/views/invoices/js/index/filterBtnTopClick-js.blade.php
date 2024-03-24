<script type="text/javascript">
    function filterBtnTopClick(table) {
        $('.filterBtnTop').click(function () {
            let year = $('#year').val();
            let partner = $('#partner').val();
            let url = '{{ route('invoicesIndex', [":ev", ":partner"]) }}';
            url = url.replace(':ev', year);
            url = url.replace(':partner', partner);
            table.ajax.url(url).load();
        })
    }
</script>

