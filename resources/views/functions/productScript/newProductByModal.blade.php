<script type="text/javascript">

    function newProductByModal() {
        $.ajax({
            method: 'POST',
            url: "{{url('api/newProductByModal')}}",
            data: {
                name: $('#name').val(),
                quantities_id: $('#quantities').val(),
                price: $('#price').val(),
                supplierprice:  $('#supplierprice').val(),
                description:  $('#description').val(),
                active:  $('#active').val()
            },
            success: function(response) {
                var productSelect = $('#products_id');
                productSelect.empty();
                $.each(response.products, function(index, product) {
                    productSelect.append('<option value="' + product.id + '">' + product.name + '</option>');
                });

                $('#addProductModal').modal('hide');
                $('#products_id').val(response.product.id);
                $('#quantities_id').val(response.product.quantities_id);
                $.ajax({
                    method: 'POST',
                    url: "{{url('api/getQuantity')}}",
                    data: {
                        id: response.product.quantities_id,
                    },
                    success: function(response) {
                        $('#quantities_text').prop('readonly', false);
                        $("#quantities_text").val(response.quantity.name);
                        $('#quantities_text').prop('readonly', true);
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





