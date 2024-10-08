@include('functions.ajax_js')
@include('functions.addDate_js')
@include('functions.required_js')
@include('functions.sweetalert_js')

<script type="text/javascript">
    $(function () {

        ajaxSetup();

        RequiredBackgroundModify('.form-control')

        function dateFieldModifying( tf, color) {
            $('#performancedate').attr('readonly', tf);
            $('#deadline').attr('readonly', tf);
            $("#deadline").css("background-color", color);
            $("#performancedate").css("background-color", color);
        }


        function paymentMethodDate(isDated) {
            var paymentMethod = $('#paymentmethod_id').val();
            var dated = $('#dated').val();
            $('#performancedate').val(dated);
            if (paymentMethod == 1 || paymentMethod == 3) {
                if (Date.parse(dated)){
                    $('#deadline').val(dated);
                    $('#performancedate').val(dated);
                    dateFieldModifying(true, "lightgray");
                    isDated ? $('#description').focus() : $('#amount').focus();
                } else {
                    dateFieldModifying(false, "yellow");
                }
            } else {
                dateFieldModifying(false, "yellow");
                if (paymentMethod == 2) {
                    if (Date.parse(dated)) {
                        var deadline = addDate(dated, 8);
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
