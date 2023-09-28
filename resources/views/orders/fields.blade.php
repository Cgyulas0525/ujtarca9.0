<div class="form-group col-sm-6">
    {!! Form::label('ordernumber', 'Megrendelés szám:') !!}
    {!! Form::text('ordernumber', isset($orders) ? $orders->ordernumber : OfferService::nextOrderNumber(), ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true']) !!}
</div>

<!-- Offerdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('orderdate', 'Dátum:') !!}
    {!! Form::date('orderdate', isset($orders) ? $orders->orderdate : Carbon\Carbon::now(), ['class' => 'form-control','id'=>'orderdate']) !!}
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
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>
