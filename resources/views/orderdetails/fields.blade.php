@section('css')
    @include('layouts.costumcss')
@endsection
<!-- Products Id Field -->
<div class="form-group col-sm-5">
    {!! Form::label('products_id', 'Termék:') !!}
    {!! Form::select('products_id', SelectService::orderDetailsProductsSelect($orders->id), null,
                ['class'=>'select2 form-control', 'id' => 'products_id', 'required' => true]) !!}
</div>

@include('layouts.modalBtn', [ 'title' => 'Új termék'])

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

<!-- Ordertype Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('ordertype', 'OrderType:') !!}
    {!! Form::hidden('ordertype', (($_COOKIE['orderType'] == 'CUSTOMER') ? 'vevői' : 'szállítói'), ['class' => 'form-control']) !!}
</div>

{{--@include('layouts.modal', [--}}
{{--        'addModal' => 'addModal',--}}
{{--        'title' => 'Új termék hozzáadása',--}}
{{--        'fields' => 'orderdetails.modalFields',--}}
{{--    ])--}}


@section('scripts')

    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>

    @include('orderdetails.js.order-detail-product-change')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            RequiredBackgroundModify('.form-control')

            $('#products_id').change(function() {
                orderDetailProductChange();
            });
        });
    </script>
@endsection
