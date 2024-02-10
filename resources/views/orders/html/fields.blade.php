@section('css')
    @include('layouts.costumcss')
@endsection

<div class="form-group col-sm-6">
    {!! Form::label('ordernumber', 'Megrendelés szám:') !!}
    {!! Form::text('ordernumber', isset($orders) ? $orders->ordernumber : OrderService::nextOrderNumber(),
        ['class' => 'form-control','maxlength' => 25, 'readonly' => 'true', 'id' => 'ordernumber']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('orderdate', 'Dátum:') !!}
    {!! Form::date('orderdate', isset($orders) ? $orders->orderdate : Carbon\Carbon::now(),
        ['class' => 'form-control','id'=>'orderdate', 'readonly' => isset($detail) ? 'true' : 'false']) !!}
</div>

<!-- Partners Id Field -->
<div class="form-group col-sm-6">
    @if (Str::lower(App\Services\OrderService::orderTypeByCookie()) == 'vevői megrendelés')
        @include('orders.html.fields.delivery.field')
    @endif
    @include('orders.html.fields.partner.field')
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4, 'readonly' => isset($detail) ? 'true' : 'false']) !!}
</div>
@include('orders.html.fields.hidden.field')
@if (!isset($detail))
    @include('orders.html.include-modals')
@else
    @include('orders.html.edit-details.order-details-table')
@endif
