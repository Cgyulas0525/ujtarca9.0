@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection


<div class="form-group col-sm-6">
    {!! Form::label('ordernumber', 'Megrendelés szám:') !!}
    {!! Form::text('ordernumber', isset($orders) ? $orders->ordernumber : OrderService::nextOrderNumber(), ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'ordernumber']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('orderdate', 'Dátum:') !!}
    {!! Form::date('orderdate', isset($orders) ? $orders->orderdate : Carbon\Carbon::now(), ['class' => 'form-control','id'=>'orderdate']) !!}
</div>

<!-- Partners Id Field -->
<div class="form-group col-sm-6">
    <div class="row">
        <div class="form-group col-sm-10">
            {!! Form::label('partners_id', 'Partner:') !!}
            {!! Form::select('partners_id', SelectService::selectPartnersByCookie(), null,
                        ['class'=>'select2 form-control', 'id' => 'partners_id', 'required' => true]) !!}
        </div>
        <div class="form-group col-sm-2">
            <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addPartnerModal">
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
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::hidden('ordertype', 'OrderType:') !!}
    {!! Form::hidden('ordertype', isset($orders) ? $orders->ordertype->value : Str::lower(App\Services\OrderService::orderTypeByCookie()), ['class' => 'form-control', 'id' => 'ordertype']) !!}
    {!! Form::hidden('orderid', 'Id:') !!}
    {!! Form::hidden('orderid', isset($orders) ? $orders->id : null, ['class' => 'form-control', 'id' => 'orderid']) !!}
</div>

@include('modal.partner_modal.partner_modal')
@include('modal.delivery_modal.delivery_modal')
@include('modal.location_modal.location_modal')

