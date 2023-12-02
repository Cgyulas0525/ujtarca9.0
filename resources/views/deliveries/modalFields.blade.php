<div class="form-group col-sm-12">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-12">
    {!! Form::label('postcode', 'Ir.szám:') !!}
    {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'postcode']) !!}
</div>

<!-- Settlement Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('settlement_id', 'Település:') !!}
    {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'settlement_id']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', 'Cím:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'maxlength' => 100]) !!}
</div>
