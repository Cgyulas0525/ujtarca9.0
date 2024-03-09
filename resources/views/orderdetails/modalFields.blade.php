@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('app-scaffold.css.costumcss')
@endsection

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('quantities_id', 'Mennyiségi egység:') !!}
    {!! Form::select('quantities_id', \App\Http\Controllers\QuantitiesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'quantities_id', 'required' => true]) !!}
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('price', 'Eladási ár:') !!}
        {!! Form::number('price', 0, ['class' => 'form-control  text-right', 'id' => 'price']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('supplierprice', 'Beszerzési ár:') !!}
        {!! Form::number('supplierprice', 0, ['class' => 'form-control  text-right', 'id' => 'supplierprice']) !!}
    </div>
</div>
<!-- Price Field -->

