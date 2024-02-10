<div class="col-sm-2">
    {!! Form::select('orderStatus', OrderStatusEnum::Options(), (empty($_COOKIE['orderStatus']) ? 'ORDERED' : $_COOKIE['orderStatus']),
            ['class'=>'select2 form-control', 'id' => 'orderStatus']) !!}
</div>
