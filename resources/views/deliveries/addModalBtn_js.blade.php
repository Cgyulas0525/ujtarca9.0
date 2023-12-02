<script type="text/javascript">

    function addModalBtn() {
        $.ajax({
            method: 'POST',
            url: "{{url('addLocation')}}",
            data: {
                name: $('#name').val(),
                postcode: $('#postcode').val(),
                settlement_id: $('#settlement_id').val(),
                address: $('#address').val(),
            },
            // data: $('#addForm').serialize(), // Az űrlap adatainak elküldése


            success: function(response) {
                console.log(response.message);
                // Frissítsd a select opcióit a frissített partnerlistával
                var locationSelect = $('#location_id');
                locationSelect.empty(); // Törölje az összes előző opciót

                $.each(response.locations, function(index, location) {
                    // Hozzáfűz minden új partnert a select-hez
                    locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                });

                $('#addModal').modal('hide');

                $.ajax({
                    method: 'GET',
                    url: "{{url('getLocationByName')}}",
                    data: {
                        name: $('#name').val(),
                    },
                    success: function(response) {
                        console.log(response);
                        $('#location_id').val(response)
                    },
                    error: function(error) {
                        console.error('Hiba történt:', error);
                    }
                });
            },
            error: function(error) {
                console.error('Hiba történt:', error);
            }
        });
    }

</script>



