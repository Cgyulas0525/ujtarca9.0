<script type="text/javascript">
    function loadUrl(url, table) {
        url = url.replace(':orderType', ($('#orderType').val() == 'CUSTOMER') ? 'vevői' : 'szállítói');
        url = url.replace(':orderStatus', ($('#orderStatus').val() == 'ORDERED') ? 'megrendelt' : ($('#orderStatus').val() == 'PACKAGED') ? 'csomagolt' : 'kiszállított');
        table.ajax.url(url).load();
    }
</script>
