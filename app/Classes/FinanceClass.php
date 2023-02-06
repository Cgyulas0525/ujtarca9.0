<?php

namespace App\Classes;

use DB;

class FinanceClass
{

    private $year = [];
    private $sum;

    public function __construct($year) {
        $this->year = $year;
        $this->sum = 0;
    }

    public function closuresAmountSumYear() {
        return DB::table('closures as t1')
            ->select(DB::raw('sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereIn(DB::raw('year(t1.closuredate)'), $this->year )
            ->get();
    }

    public function invoicesAmountSumYear() {
        return DB::table('invoices')
                   ->whereNull('deleted_at')
                   ->whereIn(DB::raw('year(dated)'), $this->year)
                   ->get()
                   ->sum('amount');
    }

    public static function sumPartnerInvoice($partner, $ev = null) {
        return DB::table('invoices')
            ->whereNull('deleted_at')
            ->where('partner_id', $partner)
            ->where( function($query) use ($ev) {
                if (is_null($ev) || $ev == -9999) {
                    $query->whereNotNull('dated');
                } else {
                    $query->where(DB::raw('year(dated)'), $ev);
                }
            })
            ->get()->sum('amount');
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
