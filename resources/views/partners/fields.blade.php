<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Partnertypes Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partnertypes_id', 'Partnertypes Id:') !!}
    {!! Form::number('partnertypes_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Taxnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('taxnumber', 'Taxnumber:') !!}
    {!! Form::text('taxnumber', null, ['class' => 'form-control','maxlength' => 15,'maxlength' => 15]) !!}
</div>

<!-- Bankaccount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bankaccount', 'Bankaccount:') !!}
    {!! Form::text('bankaccount', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30]) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postcode', 'Postcode:') !!}
    {!! Form::number('postcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Settlement Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('settlement_id', 'Settlement Id:') !!}
    {!! Form::number('settlement_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Phonenumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phonenumber', 'Phonenumber:') !!}
    {!! Form::text('phonenumber', null, ['class' => 'form-control','maxlength' => 20,'maxlength' => 20]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>