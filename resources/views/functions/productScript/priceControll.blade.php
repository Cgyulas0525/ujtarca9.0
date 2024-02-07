<script type="text/javascript">
    function priceControll() {
        let price = $("#price").val();
        let supplierprice = $("#supplierprice").val();
        if (price != null && supplierprice != null) {
            if (parseInt(price) < parseInt(supplierprice)) {
                sw('A beszerzési ár nem lehet nagyobb mint az ár!');
                $("#supplierprice").val(0)
                $('#supplierprice').focus();
            }
        }
    }
</script>
