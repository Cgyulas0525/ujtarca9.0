<script type="text/javascript">
    function orderDetailProductChange() {
        let product = $('#products_id').val();
        if(product != null || product == '') {
            $.ajax({
                type: "GET",
                url: "{{url('api/getProduct')}}",
                data: {id: product},
                success: function (res) {
                    $('#quantities_id').val(res.quantities_id);
                    $('#quantities_text').prop('readonly', false);
                    $("#quantities_text").val(res.quantities.name);
                    $('#quantities_text').prop('readonly', true);
                    $("#value").focus();
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

