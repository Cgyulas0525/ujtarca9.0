@section('css')
    @include('app-scaffold.css.costumcss')
@endsection
<!-- Products Id Field -->
<div class="form-group col-sm-5">
    {!! Form::label('products_id', 'Termék:') !!}
    {!! Form::select('products_id', SelectService::orderDetailsProductsSelect($orders->id), null,
                ['class'=>'select2 form-control', 'id' => 'products_id', 'required' => true]) !!}
</div>

<div class="form-group col-sm-1">
    <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addProductModal">
        Új Termék
    </button>
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quantities_text', 'Mennyiségi egység:') !!}
    {!! Form::text('quantities_text', null, ['class' => 'form-control', 'id' => 'quantities_text', 'readonly' => true ]) !!}
    {!! Form::hidden('quantities_id', null, ['class' => 'form-control', 'id' => 'quantities_id' ]) !!}
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



