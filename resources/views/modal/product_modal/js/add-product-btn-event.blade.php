<script type="text/javascript">
    function addProductBtnEvent() {
        let name = $('#name').val();
        let quantities_id = $('#quantities').val();
        let price = $('#price').val();
        let supplierprice =  $('#supplierprice').val();

        if ($('#addProductBtn').text() === 'Ellenőrzés') {
            if (name.length === 0 || quantities_id === '0' || price === '0' || supplierprice === '0') {
                productModalRequiredFields()
            } else {
                $('#addProductBtn').text('Ment');
            }
        } else {
            newProdactByModal();
        }
    }
</script>

