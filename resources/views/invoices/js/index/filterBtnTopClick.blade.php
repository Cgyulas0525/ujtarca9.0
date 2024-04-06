<script type="text/javascript">
    function filterBtnTopClick(table) {
        $('.filterBtnTop').click(function () {

            // TODO ide kell ajax hívás és kell egy session basztató kontroller amiben kell egy
            // get(param), put(param1, param2), forget(param) metódus

            let year = $('#year').val();
            let partner = $('#partner').val();
            let url = '{{ route('invoicesIndex', [":year", ":partner"]) }}';
            url = url.replace(':year', year);
            url = url.replace(':partner', partner);
            table.ajax.url(url).load();
        })
    }
</script>

