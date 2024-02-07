<?php

namespace App\Classes;

use App\Models\Orderdetails;

class OrderClass
{
    public static function sumOrderSupplierPrice($id): object
    {
        return Orderdetails::where('orders_id', $id)->get()->sum('supplierPrice');
    }
}
