<!-- Offernumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('offernumber', 'Megrendelés szám:') !!}
    {!! Form::text('offernumber', isset($offers) ? $offers->offernumber : OfferServiceController::nextOfferNumber(), ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true']) !!}
</div>

<!-- Offerdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('offerdate', 'Dátum:') !!}
    {!! Form::date('offerdate', isset($offer) ? $offers->offerdate : Carbon\Carbon::now(), ['class' => 'form-control','id'=>'offerdate']) !!}
</div>

<!-- Partners Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partners_id', 'Partner:') !!}
    {!! Form::select('partners_id', \App\Http\Controllers\PartnersController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'partners_id', 'required' => true]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>
