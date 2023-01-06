@include('functions.ajax_js')
@include('functions.sweetalert_js')
@include('functions.addDays_js')

<script type="text/javascript">
    $(function () {

        ajaxSetup();

        function paymentMethodDate(isDated) {
            var paymentMethod = $('#paymentmethod_id').val();
            var dated = $('#dated').val();
            $('#performancedate').val(dated);
            if (paymentMethod == 1 || paymentMethod == 3) {
                if (Date.parse(dated)){
                    $('#deadline').val(dated);
                    $('#performancedate').attr('readonly', true);
                    $('#deadline').attr('readonly', true);
                    isDated ? $('#description').focus() : $('#amount').focus();
                } else {
                    $('#performancedate').attr('readonly', false);
                    $('#deadline').attr('readonly', false);
                }
            } else {
                $('#performancedate').attr('readonly', false);
                $('#deadline').attr('readonly', false);
                if (paymentMethod == 2) {
                    if (Date.parse(dated)) {
                        var deadline = addDays(dated, 8);
                        $('#deadline').val(deadline);
                    }
                }
            }
        }

        $('#paymentmethod_id').change(function () {
            paymentMethodDate(false);
        });

        $('#dated').change(function () {
            paymentMethodDate(true);
        });

    });
</script>
