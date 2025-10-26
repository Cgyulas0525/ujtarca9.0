@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('app-scaffold.css.costumcss')
@endsection

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100, 'required' => true]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('quantities_id', 'Mennyiségi egység:') !!}
    {!! Form::select('quantities_id', \App\Http\Controllers\QuantitiesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'quantities_id', 'required' => true]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-2">
    {!! Form::label('price', 'Eladási ár:') !!}
    {!! Form::number('price', isset($products) ? $products->price : 0, ['class' => 'form-control  text-right', 'id' => 'price', 'required' => true]) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('supplierprice', 'Beszerzési ár:') !!}
    {!! Form::number('supplierprice', isset($products) ? $products->supplierprice : 0, ['class' => 'form-control  text-right', 'id' => 'supplierprice']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::hidden('active', 'Aktív:') !!}
    {!! Form::hidden('active', isset($products) ? $products->active->value : 'aktív', ['class' => 'form-control']) !!}
</div>

@section('scripts')
    @include('functions.ajax_js')
    @include('functions.sweetalert_js')
    @include('functions.required_js')

    <script type="text/javascript">
        var table;

        $(function () {

            ajaxSetup();

            RequiredBackgroundModify('.form-control')

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

            $('#price').change(function () {
                priceControll();
            });

            $('#supplierprice').change(function () {
                priceControll();
            });

        });

    </script>
@endsection
