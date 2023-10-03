<?php

namespace App\Classes;

use App\Enums\ActiveEnum;
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
}
