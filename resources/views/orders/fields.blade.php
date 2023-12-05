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
<div class="form-group col-sm-6">
    <div class="row">
        <div class="form-group col-sm-10">
            {!! Form::label('partners_id', 'Partner:') !!}
            {!! Form::select('partners_id', SelectService::selectPartnersByCookie(), null,
                        ['class'=>'select2 form-control', 'id' => 'partners_id', 'required' => true]) !!}
        </div>
        <div class="form-group col-sm-2">
            <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addModal">
                Új Partner
            </button>
        </div>
    </div>

    @if (Str::lower(App\Services\OrderService::orderTypeByCookie()) == 'vevői megrendelés')
        <div class="row">
            <div class="form-group col-sm-10">
                {!! Form::label('delivery_id', 'Kiszállítás:') !!}
                {!! Form::select('delivery_id', SelectService::selectDelivery(), null,
                            ['class'=>'select2 form-control', 'id' => 'delivery_id', 'required' => true]) !!}
            </div>
            <div class="form-group col-sm-2">
                <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addDeliveryModal">
                    Új Kiszállítás
                </button>
            </div>
        </div>
    @endif

{{--    @include('layouts.modalBtn', [ 'title' => 'Új partner'])--}}

</div>

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
        'addModal' => 'addModal',
        'title' => 'Új partner hozzáadása',
        'fields' => 'orders.modalFields',
    ])

@include('layouts.modal', [
        'addModal' => 'addDeliveryModal',
        'title' => 'Új kiszállítás hozzáadása',
        'fields' => 'orders.orderDeliveryModalFields',
    ])

