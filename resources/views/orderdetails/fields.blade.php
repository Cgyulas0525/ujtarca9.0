<!-- Products Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('products_id', 'Termék:') !!}
    {!! Form::select('products_id', SelectService::orderDetailsProductsSelect($orders->id), null,
                ['class'=>'select2 form-control', 'id' => 'products_id', 'required' => true]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quantities_text', 'Mennyiségi egység:') !!}
    {!! Form::text('quantities_text', null, ['class' => 'form-control', 'id' => 'quantities_text', 'readonly' => true ]) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-3">
    {!! Form::label('value', 'Mennyiség:') !!}
    {!! Form::number('value', null, ['class' => 'form-control text-right', 'id' => 'value', 'required' => true]) !!}
</div>

<!-- Offers Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('orders_id', 'Orders Id:') !!}
    {!! Form::hidden('orders_id', $orders->id, ['class' => 'form-control']) !!}
</div>
<!-- Offers Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('quantities_id', 'Offers Id:') !!}
    {!! Form::hidden('quantities_id', null, ['class' => 'form-control', 'id' => 'quantities_id']) !!}
</div>

@section('scripts')

    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/sweetalert.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            RequiredBackgroundModify('.form-control')

            $('#products_id').change(function() {
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
                                    success: function (res) {
                                        if (res.name != null || res.name == '') {
                                            $("#quantities_text").val(res.name);
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
            });

        });
    </script>
@endsection
