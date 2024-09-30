@include('functions.ajax_js')
@include('functions.required_js')
@include('functions.sweetalert_js')
@include('functions.settlement.settlementPostcode_js')


<script type="text/javascript">
    $(function () {

        ajaxSetup();

        $('#taxnumber').inputmask();
        $('#bankaccount').inputmask();
        $('#phonenumber').inputmask();

        RequiredBackgroundModify('.form-control')

    });
</script>
