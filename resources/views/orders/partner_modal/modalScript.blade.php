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
    }

    function addPartnerBtnEvent() {
        let name = $('#name').val();
        let postcode = $('#postcode').val();
        let settlement_id = $('#settlement_id').val();
        let partnertypes_id =  $('#partnertypes_id').val();
        let email =  $('#email').val();
        let address =  $('#address').val();

        if (name.length === 0 || postcode === '0' || settlement_id === '0' || email.length === 0 || partnertypes_id === '0' || address.length === 0) {
            modalRequiredFields();
        } else {

            //  TODO nem a loaction-t, hanem a partner kell felvinni...

            {{--$.ajax({--}}
            {{--    method: 'GET',--}}
            {{--    url: "{{url('getLocationByName')}}",--}}
            {{--    data: {--}}
            {{--        name: name,--}}
            {{--    },--}}
            {{--    success: function(response) {--}}
            {{--        try {--}}
            {{--            var responseObject = JSON.parse(response);--}}
            {{--            if (responseObject === null) {--}}
            {{--                console.log('A JSON válasz objektum null.');--}}
            {{--            } else {--}}
            {{--                $('#name').focus();--}}
            {{--                $('#name').val(null);--}}
            {{--                sw('Van már ilyen nevű cím');--}}
            {{--            }--}}
            {{--        } catch (error) {--}}
            {{--            $.ajax({--}}
            {{--                method: 'POST',--}}
            {{--                url: "{{url('addLocation')}}",--}}
            {{--                data: {--}}
            {{--                    name: name,--}}
            {{--                    postcode: postcode,--}}
            {{--                    settlement_id: settlement_id,--}}
            {{--                    address: address,--}}
            {{--                },--}}
            {{--                success: function(response) {--}}
            {{--                    console.log(response.message);--}}
            {{--                    var locationSelect = $('#location_id');--}}
            {{--                    locationSelect.empty();--}}
            {{--                    $.each(response.locations, function(index, location) {--}}
            {{--                        locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');--}}
            {{--                    });--}}
            {{--                    $('#addModal').modal('hide');--}}
            {{--                    $('#location_id').val(response.location.id)--}}
            {{--                },--}}
            {{--                error: function(error) {--}}
            {{--                    console.error('Hiba történt:', error);--}}
            {{--                }--}}
            {{--            });--}}
            {{--        }--}}
            {{--    },--}}
            {{--    error: function(error) {--}}
            {{--        console.error('Hiba történt:', error);--}}
            {{--    }--}}
            {{--});--}}
        }
    }

</script>



