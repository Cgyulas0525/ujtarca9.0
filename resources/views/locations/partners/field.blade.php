@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<!-- Name Field -->

<div class="form-group col-sm-12">
    <div class="row">
        <div class="form-group col-sm-6">
            {!! Form::label('name', 'Név:') !!}
            {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100, 'required' => true]) !!}
        </div>

        <!-- Quantities Id Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('partnertypes_id', 'Típus:') !!}
            {!! Form::text('partnertypes_name', $partnertype->name, ['class' => 'form-control', 'id' => 'partnertypes_name', 'readonly' => true]) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <div class="row">
        <div class="form-group col-sm-2">
            {!! Form::label('postcode', 'Ir.szám:') !!}
            {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(), null,
                ['class' => 'select2 form-control', 'id' => 'postcode']) !!}
        </div>

        <div class="form-group col-sm-4">
            {!! Form::label('settlement_id', 'Település:') !!}
            {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(), null,
                ['class' => 'select2 form-control', 'id' => 'settlement_id']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('address', 'Cím:') !!}
            {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 50]) !!}

            {!! Form::hidden('partnertypes_id', $partnertype->id, ['class' => 'form-control', 'id' => 'partnertypes_id']) !!}
            {!! Form::hidden('active', App\Enums\ActiveEnum::ACTIVE->value, ['class' => 'form-control', 'id' => 'active']) !!}
            {!! Form::hidden('location_id', $location->id, ['class' => 'form-control', 'id' => 'active']) !!}
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('description', 'Megjegyzés:') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
        </div>
    </div>
</div>

