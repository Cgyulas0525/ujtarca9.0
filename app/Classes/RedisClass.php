<?php

namespace App\Classes;

use App\Enums\OrderStatusEnum;
use App\Enums\OrderTypeEnum;
use App\Models\Orders;
use App\Models\Partners;
use App\Models\Products;
use Illuminate\Support\Facades\Redis;

class RedisClass
{
    public static function setexProducts(): void
    {
        $redis = Redis::connection();
        $redis->setex('products_all', 3600, Products::with('quantities')->get());
        $redis->setex('products_inactive', 3600, Products::with('quantities')->inActiveProducts()->get());
        $redis->setex('products_active', 3600, Products::with('quantities')->activeProducts()->get());
    }

    public static function setexPartners(): void
    {
        $redis = Redis::connection();
        $redis->setex('partners_all', 3600, Partners::with('partnertypes')->get());
        $redis->setex('partners_inactive', 3600, Partners::with('partnertypes')->inActivePartner()->get());
        $redis->setex('partners_active', 3600, Partners::with('partnertypes')->activePartner()->get());
    }

    public static function setexOrders(): void
    {
        OrderClass::setOrdersRedisFile('orders_customer_ordered', OrderTypeEnum::CUSTOMER->value, OrderStatusEnum::ORDERED->value);
        OrderClass::setOrdersRedisFile('orders_customer_packaged', OrderTypeEnum::CUSTOMER->value, OrderStatusEnum::PACKAGED->value);
        OrderClass::setOrdersRedisFile('orders_customer_delivered', OrderTypeEnum::CUSTOMER->value, OrderStatusEnum::DELIVERED->value);
        OrderClass::setOrdersRedisFile('orders_supplier_ordered', OrderTypeEnum::SUPPLIER->value, OrderStatusEnum::ORDERED->value);
        OrderClass::setOrdersRedisFile('orders_supplier_packaged', OrderTypeEnum::SUPPLIER->value, OrderStatusEnum::PACKAGED->value);
        OrderClass::setOrdersRedisFile('orders_supplier_delivered', OrderTypeEnum::SUPPLIER->value, OrderStatusEnum::DELIVERED->value);
    }
}

