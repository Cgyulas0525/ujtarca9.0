<script type="text/javascript">

    $('#addDeliveryBtn').click(function() {
        addDeliveryBtnEvent();
    });

    $('#date').change(function () {
        dateChange();
    })

    $('#location_id').change(function () {
        locationChange();
    })

    function modalRequiredFields() {
        if (requiredField('date', 'Dátum')) {
            requiredField('location_id', 'Cím')
        }
    }

    function addDeliveryBtnEvent() {

        let date = $('#date').val();
        let location_id = $('#location_id').val();
        let description = $('#description').val();
        let delivery_number =  $('#delivery_number').val();

        console.log(date, location_id, description, delivery_number);

        // if (name.length === 0 || postcode === '0' || settlement_id === '0' || email.length === 0 || partnertypes_id === '0' || address.length === 0) {
        //     modalRequiredFields();
        // } else {
        //     newDeliveryByModal();
        // }
    }

</script>



