<?php

namespace App\Classes;

use App\Models\Orderdetails;
use App\Models\Orders;
use Illuminate\Support\Facades\Redis;

class OrderClass
{
    public static function sumOrderSupplierPrice($id): object
    {
        return Orderdetails::where('orders_id', $id)->get()->sum('supplierPrice');
    }

    public static function setOrdersRedisFile($name, ?string $type = null, ?string $status = null): void
    {
        Redis::setex($name, 3600, Orders::with('partners', 'delivery')->ordersByTypeAndStatus($type, $status)->get());
    }
}
