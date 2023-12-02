<script type="text/javascript">

    function addModalBtnEvent() {
        let name = $('#name').val();
        let postcode = $('#postcode').val();
        let settlement_id = $('#settlement_id').val();
        let address =  $('#address').val();
        console.log(name.length, postcode, settlement_id);
        if (name.length === 0 || postcode === '0' || settlement_id === '0') {
            if (name.length === 0) {
                $('#name').focus();
                sw('A név kötelező mező!');
            } else {
                if (postcode === '0') {
                    $('#postcode').focus();
                    sw('Az irányítószám kötelező mező!');
                } else {
                    if (settlement_id === '0') {
                        $('#settlement_id').focus();
                        sw('A település kötelező mező!');
                    }
                }
            }
        } else {
            $.ajax({
                method: 'GET',
                url: "{{url('getLocationByName')}}",
                data: {
                    name: name,
                },
                success: function(response) {
                    try {
                        var responseObject = JSON.parse(response);
                        if (responseObject === null) {
                            console.log('A JSON válasz objektum null.');
                        } else {
                            $('#name').focus();
                            $('#name').val(null);
                            sw('Van már ilyen nevű cím');
                        }
                    } catch (error) {
                        $.ajax({
                            method: 'POST',
                            url: "{{url('addLocation')}}",
                            data: {
                                name: name,
                                postcode: postcode,
                                settlement_id: settlement_id,
                                address: address,
                            },
                            success: function(response) {
                                console.log(response.message);
                                var locationSelect = $('#location_id');
                                locationSelect.empty();
                                $.each(response.locations, function(index, location) {
                                    locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                                });
                                $('#addModal').modal('hide');
                                $('#location_id').val(response.location.id)
                            },
                            error: function(error) {
                                console.error('Hiba történt:', error);
                            }
                        });
                    }
                },
                error: function(error) {
                    console.error('Hiba történt:', error);
                }
            });
        }
    }

</script>



