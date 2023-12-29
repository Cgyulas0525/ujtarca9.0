@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 50, 'id' => 'email', 'required' => true]) !!}
    {!! Form::hidden('active', App\Enums\ActiveEnum::ACTIVE->value, ['class' => 'form-control', 'id' => 'active']) !!}
</div>
<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100, 'id' => 'name', 'required' => true]) !!}
</div>,

<!-- Quantities Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('partnertypes_id', 'Típus:') !!}
    {!! Form::select('partnertypes_id', SelectService::selectPartnerTypesByCookie(), null,
        ['class' => 'select2 form-control', 'id' => 'partnertypes_id', 'required' => true]) !!}
</div>

<div class="row">
    <div class="form-group col-sm-3">
        {!! Form::label('postcode', 'Ir.szám:') !!}
        {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(), null,
            ['class' => 'select2 form-control', 'id' => 'postcode', 'required' => true]) !!}
    </div>

    <div class="form-group col-sm-9">
        {!! Form::label('settlement_id', 'Település:') !!}
        {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(), null,
            ['class' => 'select2 form-control', 'id' => 'settlement_id', 'required' => true]) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('address', 'Cím:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 100, 'id' => 'address', 'required' => true]) !!}
</div>



