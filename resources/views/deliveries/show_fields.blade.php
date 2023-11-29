<!-- Delivery Number Field -->
<div class="col-sm-12">
    {!! Form::label('delivery_number', 'Delivery Number:') !!}
    <p>{{ $delivery->delivery_number }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $delivery->date }}</p>
</div>

<!-- Location Id Field -->
<div class="col-sm-12">
    {!! Form::label('location_id', 'Location Id:') !!}
    <p>{{ $delivery->location_id }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $delivery->description }}</p>
</div>

