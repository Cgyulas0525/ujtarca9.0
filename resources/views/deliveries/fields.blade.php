@section('css')
{{--    @include('layouts.datatables_css')--}}
    @include('layouts.costumcss')
@endsection

@include('layouts.modal', [
        'title' => 'Új cím hozzáadása',
        'fields' => 'deliveries.modalFields',
    ])
<!-- Delivery Number Field -->
<div class="form-group col-sm-2">
    {!! Form::label('delivery_number', 'Sorszám:') !!}
    {!! Form::text('delivery_number', isset($delivery) ? $delivery->delivery_number : App\Services\DeliveryService::nextDeliveryNumber(),
        ['class' => 'form-control', 'readonly' => true]) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date', 'Dátum:') !!}
    {!! Form::date('date', isset($delivery) ? $delivery->date : \Carbon\Carbon::now()->toDateString(),
        ['class' => 'form-control','id'=>'date', 'required' => true]) !!}
</div>

<!-- Location Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Cím:') !!}
    {!! Form::select('location_id', App\Http\Controllers\LocationController::DDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'location_id', 'required' => true]) !!}
</div>

@include('layouts.modalBtn', [ 'title' => 'Új cím'])

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
    {!! Form::hidden('id', isset($delivery) ? $delivery->id : null, ['class' => 'form-control', 'id' => 'id']) !!}
</div>


