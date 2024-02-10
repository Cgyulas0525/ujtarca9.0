<div class="form-group col-sm-6">
    {!! Form::hidden('ordertype', 'OrderType:') !!}
    {!! Form::hidden('ordertype', isset($orders) ? $orders->ordertype->value : Str::lower(App\Services\OrderService::orderTypeByCookie()), ['class' => 'form-control', 'id' => 'ordertype']) !!}
    {!! Form::hidden('orderid', 'Id:') !!}
    {!! Form::hidden('orderid', isset($orders) ? $orders->id : null, ['class' => 'form-control', 'id' => 'orderid']) !!}
</div>
