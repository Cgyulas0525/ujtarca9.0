<div class="form-group col-sm-6">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantities_id', 'Mennyiségi egység:') !!}
    {!! Form::select('quantities_id', \App\Http\Controllers\QuantitiesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'quantities_id', 'required' => true]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Eladási ár:') !!}
    {!! Form::number('price', isset($products) ? $products->price : 0, ['class' => 'form-control  text-right', 'id' => 'price']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('supplierprice', 'Beszerzési ár:') !!}
    {!! Form::number('supplierprice', isset($products) ? $products->supplierprice : 0, ['class' => 'form-control  text-right', 'id' => 'supplierprice']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::hidden('active', 'Aktív:') !!}
    {!! Form::hidden('active', isset($products) ? $products->active->value : 'aktív', ['class' => 'form-control']) !!}
</div>
