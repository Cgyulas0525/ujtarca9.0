<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $products->name }}</p>
</div>

<!-- Quantities Id Field -->
<div class="col-sm-12">
    {!! Form::label('quantities_id', 'Quantities Id:') !!}
    <p>{{ $products->quantities_id }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $products->price }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $products->description }}</p>
</div>

