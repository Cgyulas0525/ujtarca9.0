<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantities_id', 'Mennyiségi egység:') !!}
    {!! Form::select('quantities_id', \App\Http\Controllers\QuantitiesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'quantities_id', 'required' => true]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Ára:') !!}
    {!! Form::number('price', isset($products) ? $products->price : 0, ['class' => 'form-control  text-right', 'id' => 'price']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('supplierprice', 'Beszerzési ár:') !!}
    {!! Form::number('supplierprice', isset($products) ? $products->supplierprice : 0, ['class' => 'form-control  text-right', 'id' => 'supplierprice']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

@section('scripts')

    <script src="{{ asset('/public/js/sweetalert.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            function priceControll() {
                let price = $("#price").val();
                let supplierprice = $("#supplierprice").val();
                console.log(price, supplierprice);
                if (price != null && supplierprice != null) {
                    if (parseInt(price) < parseInt(supplierprice)) {
                        sw('A beszerzési ár nem lehet nagyobb mint az ár!');
                        $("#supplierprice").val(0)
                        $('#supplierprice').focus();
                    }
                }
            }

            $('#price').change(function() {
                priceControll();
            });

            $('#supplierprice').change(function() {
                priceControll();
            });

        });
    </script>
@endsection
