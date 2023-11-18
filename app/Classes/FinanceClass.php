<?php

namespace App\Classes;

use App\Models\Orders;

class FinanceClass
{
    public static function sumPartnerOrder($partner, $ev = null) {
        return Orders::selectRaw('sum(orderdetails.value * products.price) as amount')
            ->join('orderdetails', 'orderdetails.orders_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'orderdetails.products_id')
            ->where('orders.partners_id', $partner)
            ->where( function($query) use ($ev) {
                is_null($ev) ? $query->whereNotNull('orderdate') : $query->whereRaw('year(orderdate) =' . $ev);
            })
            ->get()->sum('amount');
    }
}
