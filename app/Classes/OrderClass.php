<?php

namespace App\Classes;

use DB;

class OrderClass
{
    public static function sumOrderSupplierPrice($id) {
        return DB::table('orderdetails')
            ->join('products', 'products.id', '=', 'orderdetails.products_id')
            ->selectRaw('sum(orderdetails.value * if(products.supplierprice is null, 0, products.supplierprice) ) as sp')
            ->where('orderdetails.orders_id', $id)
            ->whereNull('orderdetails.deleted_at')
            ->get()->first()->sp;
    }
}
