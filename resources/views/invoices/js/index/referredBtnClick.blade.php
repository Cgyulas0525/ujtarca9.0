<script type="text/javascript">
    function referredBtnClick(table) {
        $('#referredBtn').click(function () {

            // TODO ide kell ajax hívás és kell egy session basztató kontroller amiben kell egy
            // get(param), put(param1, param2), forget(param) metódus

            localStorage.setItem('invoiceReferred', 'Yes');
            let url = '{{ route('referredIndex') }}';
            table.ajax.url(url).load();
        })
    }
</script>

