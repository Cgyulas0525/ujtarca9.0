<?php

namespace App\Classes\Delivery;

use DB;

class DeliveryReportClass
{
    public function batchDeliveryReport($id)
    {
        return DB::table('deliveries')
            ->join('orders', 'deliveries.id', '=', 'orders.delivery_id')
            ->join('orderdetails', 'orders.id', '=', 'orderdetails.orders_id')
            ->join('products', 'products.id', '=', 'orderdetails.products_id')
            ->join('locations', 'locations.id', '=', 'deliveries.location_id')
            ->join('settlements', 'settlements.id', '=', 'locations.settlement_id')
            ->selectRaw('delivery_number, date, Concat(locations.name, " ", locations.postcode, " ", settlements.name, ",", locations.address) as location,
                products.name as product, sum(value) as sum')
            ->where('orders.delivery_id', $id)
            ->groupBy('delivery_number', 'date', 'location', 'product')
            ->get();
    }
}
