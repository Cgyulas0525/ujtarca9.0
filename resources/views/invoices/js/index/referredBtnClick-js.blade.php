<script type="text/javascript">
    function referredBtnClick(table) {
        $('#referredBtn').click(function () {
            let url = '{{ route('referredIndex') }}';
            table.ajax.url(url).load();
        })
    }
</script>

