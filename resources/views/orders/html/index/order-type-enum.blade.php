<div class="col-sm-1">
    {!! Form::select('orderType', OrderTypeEnum::Options(), (empty($_COOKIE['orderType']) ? 'CUSTOMER' : $_COOKIE['orderType']),
            ['class'=>'select2 form-control', 'id' => 'orderType']) !!}
</div>
