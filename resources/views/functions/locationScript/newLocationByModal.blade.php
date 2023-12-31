<script type="text/javascript">

    function newLocationByModal() {
        $.ajax({
            method: 'POST',
            url: "{{url('api/newLocationByModal')}}",
            data: {
                name: $('#location_name').val(),
                postcode: $('#location_postcode').val(),
                settlement_id: $('#location_settlement_id').val(),
                address:  $('#location_address').val()
            },
            success: function(response) {
                var locationSelect = $('#location_id');
                locationSelect.empty();
                $.each(response.locations, function(index, location) {
                    locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                });


                $('#addLocationModal').modal('hide');
                $('#location_id').val(response.location.id)
            },
            error: function(error) {
                console.error('Hiba történt:', error);
            }
        });
    }

</script>




