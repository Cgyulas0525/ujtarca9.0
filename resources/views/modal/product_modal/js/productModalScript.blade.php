@section('scripts')
<script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
<script src="{{ asset('/js/currencyFormatDE.js') }} " type="text/javascript"></script>

@include('functions.sweetalert_js')
@include('functions.requiredField')
@include('functions.ajax_js')

@include('modal.product_modal.productModalScript')
@include('functions.productScript.newProductByModal')
@include('modal.product_modal.js.add-product-btn-event')


{{--@include('orders.js.otherBtn_js')--}}

<script type="text/javascript">

    ajaxSetup();
    RequiredBackgroundModify('.form-control')

    $('#otherBtn').click(function (e) {
        var id = $('#id').val();
        if (id == null || id === 0 || id.length === 0) {
            otherBtnEvent('store');
        } else {
            otherBtnEvent('modify');
        }
    });

</script>
@endsection

