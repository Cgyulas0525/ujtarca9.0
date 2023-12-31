<script type="text/javascript">

    function newDeliveryByModal() {
        $.ajax({
            method: 'POST',
            url: "{{url('api/newDeliveryByModal')}}",
            data: {
                date: $('#date').val(),
                location_id: $('#location_id').val(),
                description: $('#description').val(),
                delivery_number:  $('#delivery_number').val(),
            },
            success: function(response) {
                var deliveriesSelect = $('#delivery_id');
                deliveriesSelect.empty();
                $.each(response.deliveries, function(index, delivery) {
                    console.log(delivery);
                    deliveriesSelect.append('<option value="' + delivery.id + '">' + delivery.deliveryFullName + '</option>');
                });
                $('#addDeliveryModal').modal('hide');
                $('#delivery_id').val(response.delivery.id)
            },
            error: function(error) {
                console.error('Hiba történt:', error);
            }
        });
    }

</script>




