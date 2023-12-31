<script type="text/javascript">

    $('#addPartnerBtn').click(function() {
        addPartnerBtnEvent();
    });



    function modalRequiredFields() {
        if (requiredField('email', 'Email')) {
            if (requiredField('name', 'Név')) {
                if (requiredField('partnertypes_id', 'Típus')) {
                    if (requiredField('postcode', 'Irányító szám')) {
                        if (requiredField('settlement_id', 'Település')) {
                            requiredField('address', 'Cím');
                        }
                    }
                }
            }
        }
        return true;
    }

    function addPartnerBtnEvent() {
        let name = $('#name').val();
        let postcode = $('#postcode').val();
        let settlement_id = $('#settlement_id').val();
        let partnertypes_id =  $('#partnertypes_id').val();
        let email =  $('#email').val();
        let address =  $('#address').val();

        if ($('#addPartnerBtn').text() === 'Ellenőrzés') {
            if (name.length === 0 || postcode === '0' || settlement_id === '0' || email.length === 0 || partnertypes_id === '0' || address.length === 0) {
                modalRequiredFields()
            } else {
                if (emailChange()) {
                    if (nameChange()) {
                        $('#addPartnerBtn').text('Ment');
                    }
                }
            }
        } else {
            newPartnerByModal();
        }
    }

</script>



