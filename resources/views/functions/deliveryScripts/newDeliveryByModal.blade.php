<script type="text/javascript">

    function newPartnerByModal() {
        $.ajax({
            method: 'POST',
            url: "{{url('api/newPartnerByModal')}}",
            data: {
                name: $('#name').val(),
                postcode: $('#postcode').val(),
                settlement_id: $('#settlement_id').val(),
                partnertypes_id:  $('#partnertypes_id').val(),
                email:  $('#email').val(),
                address:  $('#address').val()
            },
            success: function(response) {
                var partnerSelect = $('#partners_id');
                partnerSelect.empty();
                console.log(partnerSelect);
                $.each(response.partners, function(index, partner) {
                    partnerSelect.append('<option value="' + partner.id + '">' + partner.name + '</option>');
                    console.log(partner.id, partner.name);
                });
                console.log(partnerSelect);


                $('#addPartnerModal').modal('hide');
                $('#partners_id').val(response.partner.id)
            },
            error: function(error) {
                console.error('Hiba történt:', error);
            }
        });
    }

</script>




