<script type="text/javascript">
    function orderDetailProductChange() {
        let product = $('#products_id').val();
        if(product != null || product == '') {
            $.ajax({
                type: "GET",
                url: "{{url('api/getProduct')}}",
                data: {id: product},
                success: function (res) {
                    if (res.quantities_id != null || res.quantities_id == '') {
                        let quantity = res.quantities_id;
                        $('#quantities_id').val(quantity);
                        $.ajax({
                            type: "GET",
                            url: "{{url('api/getQuantity')}}",
                            data: {id: quantity},
                            success: function (response) {
                                if (response.name != null || response.name == '') {
                                    $('#quantities_text').prop('readonly', false);
                                    $("#quantities_text").val(response.name);
                                    $('#quantities_text').prop('readonly', true);

                                    $("#value").val(null);
                                    $("#value").focus();
                                }
                            }
                        });
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                    alert('Valami hiba van!');
                    $("#product_id").focus();
                }

            });
        }
    }
</script>

