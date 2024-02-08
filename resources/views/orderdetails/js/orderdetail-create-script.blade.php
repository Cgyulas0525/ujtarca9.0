@section('scripts')

    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.sweetalert_js')
    @include('functions.requiredField')
    @include('functions.ajax_js')
    @include('functions.productScript.priceControll')
    @include('functions.productScript.newProductByModal')
    @include('orderdetails.js.order-detail-product-change')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            RequiredBackgroundModify('.form-control')

            $('#products_id').change(function() {
                orderDetailProductChange();
            });

            $('#price').change(function () {
                priceControll();
            });

            $('#supplierprice').change(function () {
                priceControll();
            });

            $('#addProductBtn').click(function() {
                addProductBtnEvent();
            });

            function addProductBtnEvent() {
                let name = $('#name').val();
                let quantities_id = $('#quantities').val();
                let price = $('#price').val();
                let supplierprice =  $('#supplierprice').val();

                if ($('#addProductBtn').text() === 'Ellenőrzés') {
                    if (name.length === 0 || quantities_id === '0' || price === '0' || supplierprice === '0') {
                        productModalRequiredFields()
                    } else {
                        $('#addProductBtn').text('Ment');
                    }
                } else {
                    newProductByModal();
                }
            }

            function productModalRequiredFields() {
                if (requiredField('name', 'Név')) {
                    if (requiredField('quantities', 'Mennyiségi egység')) {
                        if (requiredField('price', 'Eladási ár')) {
                            requiredField('supplierprice', 'Beszerzési ár');
                        }
                    }
                }
                return true;
            }
        });
    </script>
@endsection
