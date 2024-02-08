@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100, 'required' => true]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('quantities', 'Mennyiségi egység:') !!}
    {!! Form::select('quantities', \App\Http\Controllers\QuantitiesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'quantities', 'required' => true]) !!}
</div>

<!-- Price Field -->
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('price', 'Eladási ár:') !!}
        {!! Form::number('price', isset($products) ? $products->price : 0, ['class' => 'form-control  text-right', 'id' => 'price', 'required' => true]) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('supplierprice', 'Beszerzési ár:') !!}
        {!! Form::number('supplierprice', isset($products) ? $products->supplierprice : 0, ['class' => 'form-control  text-right', 'id' => 'supplierprice', 'required' => true]) !!}
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::hidden('active', 'Aktív:') !!}
    {!! Form::hidden('active', isset($products) ? $products->active->value : 'aktív', ['class' => 'form-control']) !!}
</div>

