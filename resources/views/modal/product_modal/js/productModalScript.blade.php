@section('scripts')
@include('functions.required_js')
@include('functions.currencyFormatDE')

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

