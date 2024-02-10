{!! Form::label('delivery_id', 'Kiszállítás:') !!}
@if (!isset($detail))
    {!! Form::select('delivery_id', SelectService::selectDelivery(), null,
                ['class'=>'select2 form-control', 'id' => 'delivery_id',
                 'required' => true]) !!}
@else
    {!! Form::text('delivery_id', $orders->delivery->delivery_number,
        ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'delivery_number']) !!}
@endif
