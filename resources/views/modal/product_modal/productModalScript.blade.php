<script type="text/javascript">
    $(function () {
        $('#price').change(function () {
            priceControll();
        });

        $('#supplierprice').change(function () {
            priceControll();
        });

        $('#addProductBtn').click(function() {
            addProductBtnEvent();
        });

        function addProductBtnEvent() {
            let name = $('#name').val();
            let quantities_id = $('#quantities').val();
            let price = $('#price').val();

            if ($('#addProductBtn').text() === 'Ellenőrzés') {
                if (name.length === 0 || quantities_id === '0' || price === '0') {
                    if (requiredField('name', 'Név')) {
                        if (requiredField('quantities', 'Mennyiségi egység')) {
                            requiredField('price', 'Eladási ár');
                        }
                    }
                    //
                    // productModalRequiredFields()
                } else {
                    $('#addProductBtn').text('Ment');
                }
            } else {
                newProductByModal();
            }
        }

        function productModalRequiredFields() {
            if (requiredField('name', 'Név')) {
                if (requiredField('quantities', 'Mennyiségi egység')) {
                    requiredField('price', 'Eladási ár');
                }
            }
            return true;
        }

    });
</script>


