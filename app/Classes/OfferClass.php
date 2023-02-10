<?php

namespace App\Classes;

use DB;

class OfferClass
{
    public static function sumOfferSupplierPrice($id) {
        return DB::table('offerdetails')
            ->join('products', 'products.id', '=', 'offerdetails.products_id')
            ->selectRaw('sum(offerdetails.value * if(products.supplierprice is null, 0, products.supplierprice) ) as sp')
            ->where('offerdetails.offers_id', $id)
            ->whereNull('offerdetails.deleted_at')
            ->get()[0]->sp;
    }
}
