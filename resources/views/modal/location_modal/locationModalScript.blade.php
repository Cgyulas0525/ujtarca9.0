<script type="text/javascript">


    $('#addLocationBtn').click(function() {
        addLocationBtnEvent();
    });

    $('#location_postcode').change(function () {
        postcodeChange();
    });

    $('#location_settlement_id').change(function () {
        settlementChange();
    });


    function modalRequiredFields() {
        if (requiredField('location_name', 'Név')) {
            if (requiredField('location_postcode', 'Irányító szám')) {
                if (requiredField('location_settlement_id', 'Település')) {
                    return requiredField('location_address', 'Cím');
                }
            }
        }
        return true;
    }

    function addLocationBtnEvent() {

        let name = $('#location_name').val();
        let postcode = $('#location_postcode').val();
        let settlement_id = $('#location_settlement_id').val();
        let address =  $('#location_address').val();

        if ($('#addLocationBtn').text() === 'Ellenőrzés') {
            console.log(name, postcode, settlement_id, address)
            if (name.length === 0 || postcode === '0' || settlement_id === '0' || address.length === 0) {
                modalRequiredFields()
            } else {
                locationName();
            }
        } else {
            newLocationByModal();
        }
    }

</script>



