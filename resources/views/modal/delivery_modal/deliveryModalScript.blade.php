<script type="text/javascript">

    $('#addDeliveryBtn').click(function() {
        addDeliveryBtnEvent();
    });

    function modalRequiredFields() {
        if (requiredField('date', 'Dátum')) {
            return requiredField('location_id', 'Cím')
        }
        return true;
    }

    function addDeliveryBtnEvent() {

        let date = $('#date').val();
        let location_id = $('#location_id').val();
        let description = $('#description').val();
        let delivery_number =  $('#delivery_number').val();

        if ($('#addDeliveryBtn').text() === 'Ellenőrzés') {
            if (date.length === 0 || location_id === '0') {
                modalRequiredFields()
            } else {
                if (dateChange()) {
                    if (locationChange()) {
                        dateLocationChange();
                    }
                }
            }
        } else {
            newDeliveryByModal();
        }
    }

</script>



