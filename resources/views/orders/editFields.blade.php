<!-- Offernumber Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('ordernumber', 'Megrendelés szám:') !!}
    {!! Form::hidden('ordernumber', isset($orders) ? $orders->ordernumber : OrderService::nextOfferNumber(), ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true']) !!}
</div>

<!-- Offerdate Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('orderdate', 'Dátum:') !!}
    {!! Form::hidden('orderdate', isset($order) ? $orders->orderdate : Carbon\Carbon::now(), ['class' => 'form-control','id'=>'orderdate']) !!}
</div>

<!-- Partners Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partners_id', 'Partner:') !!}
    {!! Form::select('partners_id', SelectService::selectSuplier(), null,
                ['class'=>'select2 form-control', 'id' => 'partners_id', 'required' => true]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 1]) !!}
</div>

