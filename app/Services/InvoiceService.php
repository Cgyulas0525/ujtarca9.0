<?php

namespace App\Services;

use App\Models\Invoices;
use Carbon\Carbon;
use DB;

class InvoiceService
{
    public function bestSupplier($year = null, $count = null)
    {

        $datas = Invoices::with('partner')
            ->selectRaw('sum(amount) as sumamount, sum(1) as invoiceCount, partner_id')
            ->where(function($q) use($year) {
                if (is_null($year) || ($year == -9999)) {
                    $q->whereNotNull('dated');
                } else {
                    $q->whereYear('dated', $year);
                }
            })
            ->groupBy('partner_id')
            ->orderBy('sumamount', 'desc')
            ->get();

        return is_null($count) ? $datas : $datas->take($count);

    }

    public function partnerInvoicesPeriod($witch, $begin = null, $end = null, $partner = null) {

        $selectMonth = 'partner_id, concat(year(dated), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as period, sum(amount) as amount';
        $selectWeek  = 'partner_id, concat(year(dated), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as period, sum(amount) as amount';
        $selectYear  = 'partner_id, year(dated) as period, sum(amount) as amount';

        return Invoices::with('partner')
            ->select(DB::raw($witch === 'M' ? $selectMonth : ($witch === 'W' ? $selectWeek : $selectYear)))
            ->whereBetween('dated', [is_null($begin) ? Invoices::first()->dated : $begin, is_null($end) ? Carbon::now() : $end])
            ->where( function($query) use ($partner) {
                if (is_null($partner)) {
                    $query->whereNotNull('partner_id');
                } else {
                    $query->where('partner_id', '=', $partner);
                }
            })
            ->groupBy('partner_id', 'period')
            ->get();

    }

    public function partnerInvicesPeriodAverage($witch, $begin = null, $end = null, $partner = null) {

        $datas = $this->partnerInvoicesPeriod($witch, $begin, $end, $partner);
        return Round( $datas->sum('amount') / $datas->count(), 0);

    }
}
