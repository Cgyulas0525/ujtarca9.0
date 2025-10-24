{!! Form::label('partners_id', 'Partner:') !!}
@if (!isset($detail))
    {!! Form::select('partners_id',
                [" " ] + App\Models\Partners::whereIn('partnertypes_id', [3,9,10])->pluck('name', 'id')->toArray(),
                    isset($orders) ? $orders->partners_id : null,
                ['class'=>'select2 form-control', 'id' => 'partners_id',
                 'required' => true]) !!}
@else
    {!! Form::text('partners_id', $orders->partners->name,
        ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'partner_name']) !!}
@endif
