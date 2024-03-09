<script type="text/javascript">
    function featuresSaving() {
        $('#featuresSaving').click(function () {
            var features = $('#features').val();
            if (features.length > 0) {
                callSwal();
            }
        });
    }

    function callSwal(features) {
        swal.fire({
            title: "Jellemző mentés inaktíválás!",
            text: "Biztosan menti a jellemzőket a termékhez?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Mentés",
            cancelButtonText: "Kilép",
        }).then((result) => {
            if (result.isConfirmed) {
                callResult(features);
            }
        });
    }

    function callResult(features) {
        var product = <?php echo $products->id; ?>;
        $.ajax({
            type: "POST",
            url: "{{url('api/partnerInactivation')}}",
            data: {product: product, features: features},
            success: function (response) {
                console.log('ok:', response);
                window.location.reload(true);
            },
            error: function (response) {
                console.log('Error:', response);
                alert('nem ok');
            }
        });
    }

</script>

