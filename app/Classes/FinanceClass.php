<?php

namespace App\Classes;

use DB;

class FinanceClass
{

    private $year = [];

    public function __construct($year) {
        $this->year = $year;
    }

    public static function sumPartnerOffer($partner, $ev = null) {
        return DB::table('offers')
            ->join('offerdetails', 'offerdetails.offers_id', '=', 'offers.id')
            ->join('products', 'products.id', '=', 'offerdetails.products_id')
            ->select(DB::raw('sum(offerdetails.value * products.price) as amount'))
            ->whereNull('deleted_at')
            ->where('partner_id', $partner)
            ->where( function($query) use ($ev) {
                if (is_null($ev) || $ev == -9999) {
                    $query->whereNotNull('offerdate');
                } else {
                    $query->where(DB::raw('year(offerdate)'), $ev);
                }
            })
            ->get()->sum('amount');
    }


}
