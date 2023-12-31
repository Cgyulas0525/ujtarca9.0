<script type="text/javascript">
    function settlementChange() {
        let postcode = $('#location_postcode').val() != 0 ? $('#location_postcode').val() : null;
        let settlement_id = $('#location_settlement_id').val() != 0 ? $('#location_settlement_id').val() : null;
        if ($('#location_settlement_id').val() != 0) {
            $.ajax({
                type: "GET",
                url: "{{url('settlementPostcodeByDDDW')}}?id=" + settlement_id,
                success: function (res) {
                    if (res) {
                        console.log(res)
                        $("#location_postcode").empty();
                        // $("#settlement_id").append('<option></option>');
                        $.each(res, function (key, value) {
                            $("#location_postcode").append('<option value="' + value.postcode + '">' + value.postcode + '</option>');
                        });

                        if (postcode != null) {
                            $('#location_postcode').val(postcode);
                        }

                    } else {
                        $("#location_postcode").empty();
                    }
                }
            });
        } else {
            $("#location_postcode").empty();
        }
    }
</script>
