<?php

namespace App\Classes;

use DB;

class FinanceClass
{

    private $year = [];

    public function __construct($year) {
        $this->year = $year;
    }

    public static function sumPartnerOrder($partner, $ev = null) {
        return DB::table('orders')
            ->join('orderdetails', 'orderdetails.orders_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'orderdetails.products_id')
            ->select(DB::raw('sum(orderdetails.value * products.price) as amount'))
            ->whereNull('deleted_at')
            ->where('partner_id', $partner)
            ->where( function($query) use ($ev) {
                if (is_null($ev) || $ev == -9999) {
                    $query->whereNotNull('orderdate');
                } else {
                    $query->where(DB::raw('year(orderdate)'), $ev);
                }
            })
            ->get()->sum('amount');
    }


}
