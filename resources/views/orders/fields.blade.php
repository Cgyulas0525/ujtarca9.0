@if (isset($orders))
    <div class="form-group col-sm-6">
        {!! Form::hidden('ordernumber', 'Megrendelés szám:') !!}
        {!! Form::hidden('ordernumber', isset($orders) ? $orders->ordernumber : OrderService::nextOrderNumber(), ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true']) !!}
    </div>

    <!-- Offerdate Field -->
    <div class="form-group col-sm-6">
        {!! Form::hidden('orderdate', 'Dátum:') !!}
        {!! Form::hidden('orderdate', isset($orders) ? $orders->orderdate : Carbon\Carbon::now(), ['class' => 'form-control','id'=>'orderdate']) !!}
    </div>
@else
    <div class="form-group col-sm-6">
        {!! Form::label('ordernumber', 'Megrendelés szám:') !!}
        {!! Form::text('ordernumber', isset($orders) ? $orders->ordernumber : OrderService::nextOrderNumber(), ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true']) !!}
    </div>

    <!-- Offerdate Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('orderdate', 'Dátum:') !!}
        {!! Form::date('orderdate', isset($orders) ? $orders->orderdate : Carbon\Carbon::now(), ['class' => 'form-control','id'=>'orderdate']) !!}
    </div>
@endif

<!-- Partners Id Field -->
<div class="form-group col-sm-5">
    {!! Form::label('partners_id', 'Partner:') !!}
    {!! Form::select('partners_id', SelectService::selectPartnersByCookie(), null,
                ['class'=>'select2 form-control', 'id' => 'partners_id', 'required' => true]) !!}
</div>

@include('layouts.modalBtn', [ 'title' => 'Új partner'])
<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('ordertype', 'OrderType:') !!}
    {!! Form::hidden('ordertype', isset($orders) ? $orders->ordertype->value : Str::lower(App\Services\OrderService::orderTypeByCookie()), ['class' => 'form-control']) !!}
</div>

@include('layouts.modal', [
        'title' => 'Új partner hozzáadása',
        'fields' => 'orders.modalFields',
    ])


