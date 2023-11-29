<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $location->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $location->description }}</p>
</div>

<!-- Postcode Field -->
<div class="col-sm-12">
    {!! Form::label('postcode', 'Postcode:') !!}
    <p>{{ $location->postcode }}</p>
</div>

<!-- Settlement Id Field -->
<div class="col-sm-12">
    {!! Form::label('settlement_id', 'Settlement Id:') !!}
    <p>{{ $location->settlement_id }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $location->address }}</p>
</div>

