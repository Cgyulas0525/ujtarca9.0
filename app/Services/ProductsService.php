<?php

namespace App\Services;

use App\Models\Products;
use App\Models\Orderdetails;
use App\Enums\OrderTypeEnum;

class ProductsService
{
    public function getProductPriceByOrderType(Orderdetails $orderdetails): int
    {
        return ($orderdetails->orders->ordertype == OrderTypeEnum::SUPPLIER) ? Products::find($orderdetails->products_id)->supplierprice : Products::find($orderdetails->products_id)->price;
    }
}
