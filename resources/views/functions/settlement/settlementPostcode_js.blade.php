<script type="text/javascript">
    $('#postcode').change(function () {
        let postcode = $('#postcode').val() != 0 ? $('#postcode').val() : null;
        let settlement_id = $('#settlement_id').val() != 0 ? $('#settlement_id').val() : null;
        if ($('#postcode').val() != 0) {
            $.ajax({
                type: "GET",
                url: "{{url('postcodeSettlementDDDW')}}?postcode=" + postcode,
                success: function (res) {
                    if (res) {
                        console.log(res)
                        $("#settlement_id").empty();
                        // $("#settlement_id").append('<option></option>');
                        $.each(res, function (key, value) {
                            $("#settlement_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        if (settlement_id != null) {
                            $('#settlement_id').val(settlement_id);
                        }

                    } else {
                        $("#settlement_id").empty();
                    }
                }
            });
        } else {
            $("#settlement_id").empty();
        }
    });

    $('#settlement_id').change(function () {
        let postcode = $('#postcode').val() != 0 ? $('#postcode').val() : null;
        let settlement_id = $('#settlement_id').val() != 0 ? $('#settlement_id').val() : null;
        if ($('#settlement_id').val() != 0) {
            $.ajax({
                type: "GET",
                url: "{{url('settlementPostcodeByDDDW')}}?id=" + settlement_id,
                success: function (res) {
                    if (res) {
                        console.log(res)
                        $("#postcode").empty();
                        // $("#settlement_id").append('<option></option>');
                        $.each(res, function (key, value) {
                            $("#postcode").append('<option value="' + value.postcode + '">' + value.postcode + '</option>');
                        });

                        if (postcode != null) {
                            $('#postcode').val(postcode);
                        }

                    } else {
                        $("#postcode").empty();
                    }
                }
            });
        } else {
            $("#postcode").empty();
        }
    });
</script>
