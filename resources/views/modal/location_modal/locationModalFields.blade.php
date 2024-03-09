@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('app-scaffold.css.costumcss')

@endsection

<!-- Delivery Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('location_name', null, ['class' => 'form-control', 'id' => 'location_name', 'required']) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-12">
    {!! Form::label('postcode', 'Ir.szám:') !!}
    {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'location_postcode', 'required']) !!}
</div>

<!-- Settlement Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('settlement_id', 'Település:') !!}
    {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'location_settlement_id', 'required']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', 'Cím:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'location_address', 'maxlength' => 100, 'required']) !!}
</div>
