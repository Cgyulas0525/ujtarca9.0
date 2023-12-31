<script type="text/javascript">
    function postcodeChange() {
        let postcode = $('#location_postcode').val() != 0 ? $('#location_postcode').val() : null;
        let settlement_id = $('#location_settlement_id').val() != 0 ? $('#location_settlement_id').val() : null;
        if ($('#location_postcode').val() != 0) {
            $.ajax({
                type: "GET",
                url: "{{url('postcodeSettlementDDDW')}}?postcode=" + postcode,
                success: function (res) {
                    if (res) {
                        console.log(res)
                        $("#location_settlement_id").empty();
                        // $("#settlement_id").append('<option></option>');
                        $.each(res, function (key, value) {
                            $("#location_settlement_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        if (settlement_id != null) {
                            $('#location_settlement_id').val(settlement_id);
                        }

                    } else {
                        $("#location_settlement_id").empty();
                    }
                }
            });
        } else {
            $("#location_settlement_id").empty();
        }
    }
</script>
