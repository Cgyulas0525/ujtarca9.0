@section('css')
    @include('layouts.costumcss')
@endsection


<div class="form-group col-sm-6">
    {!! Form::label('ordernumber', 'Megrendelés szám:') !!}
    {!! Form::text('ordernumber', isset($orders) ? $orders->ordernumber : OrderService::nextOrderNumber(),
        ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'ordernumber']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('orderdate', 'Dátum:') !!}
    {!! Form::date('orderdate', isset($orders) ? $orders->orderdate : Carbon\Carbon::now(),
        ['class' => 'form-control','id'=>'orderdate', 'readonly' => isset($detail) ? 'true' : 'false']) !!}
</div>

<!-- Partners Id Field -->
<div class="form-group col-sm-6">
    <div class="row">
        <div class="form-group col-sm-10">
            {!! Form::label('partners_id', 'Partner:') !!}
            @if (!isset($detail))
                {!! Form::select('partners_id', SelectService::selectPartnersByCookie(), null,
                            ['class'=>'select2 form-control', 'id' => 'partners_id',
                             'required' => true]) !!}
            @else
                {!! Form::text('partners_id', $orders->partners->name,
                    ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'ordernumber']) !!}
            @endif
        </div>
        @if (!isset($detail))
            <div class="form-group col-sm-2">
                <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addPartnerModal">
                    Új Partner
                </button>
            </div>
        @endif
    </div>

    @if (Str::lower(App\Services\OrderService::orderTypeByCookie()) == 'vevői megrendelés')
        <div class="row">
            <div class="form-group col-sm-10">
                {!! Form::label('delivery_id', 'Kiszállítás:') !!}
                @if (!isset($detail))
                    {!! Form::select('delivery_id', SelectService::selectDelivery(), null,
                                ['class'=>'select2 form-control', 'id' => 'delivery_id',
                                 'required' => true]) !!}
                @else
                    {!! Form::text('delivery_id', $orders->delivery->delivery_number,
                        ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'ordernumber']) !!}
                @endif
            </div>
            @if (!isset($detail))
                <div class="form-group col-sm-2">
                    <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addDeliveryModal">
                        Új Kiszállítás
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4, 'readonly' => isset($detail) ? 'true' : 'false']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::hidden('ordertype', 'OrderType:') !!}
    {!! Form::hidden('ordertype', isset($orders) ? $orders->ordertype->value : Str::lower(App\Services\OrderService::orderTypeByCookie()), ['class' => 'form-control', 'id' => 'ordertype']) !!}
    {!! Form::hidden('orderid', 'Id:') !!}
    {!! Form::hidden('orderid', isset($orders) ? $orders->id : null, ['class' => 'form-control', 'id' => 'orderid']) !!}
</div>

@if (!isset($detail))
    @include('orders.html.include-modals')
@else
    @include('orders.html.edit-details.order-details-table')
@endif
