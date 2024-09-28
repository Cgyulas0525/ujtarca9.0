{!! Form::label('partners_id', 'Partner:') !!}
@if (!isset($detail))
    @if (Str::lower(OrderService::orderTypeByCookie()) == 'vevői megrendelés')
        {!! Form::select('partners_id',
                    (new App\Http\Controllers\LocationPartnerController)->getLocationPartnersToArray(
                        isset($orders) ? $orders->delivery_id : null), null,
                    ['class'=>'select2 form-control', 'id' => 'partners_id',
                     'required' => true]) !!}
    @else
        {!! Form::select('partners_id',
                    PartnerService::activeDeliveriesDDDW(), null,
                    ['class'=>'select2 form-control', 'id' => 'partners_id',
                     'required' => true]) !!}
    @endif
@else
    {!! Form::text('partners_id', $orders->partners->name,
        ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'partner_name']) !!}
@endif
