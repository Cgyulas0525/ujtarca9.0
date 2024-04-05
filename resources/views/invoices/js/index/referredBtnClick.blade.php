<script type="text/javascript">
    function referredBtnClick(table) {
        $('#referredBtn').click(function () {
            localStorage.setItem('invoiceReferred', 'Yes');
            let url = '{{ route('referredIndex') }}';
            table.ajax.url(url).load();
        })
    }
</script>

