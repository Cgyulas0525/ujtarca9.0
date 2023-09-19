<?php

namespace App\Services;

use App\Models\Invoices;
use Carbon\Carbon;

class InvoiceService
{
    public function bestSupplier($year = null, $count = null): object
    {
        $datas = Invoices::with('partner')
            ->selectRaw('sum(amount) as sumamount, sum(1) as invoiceCount, partner_id')
            ->whereNotNull('dated')
            ->orWhereYear('dated', $year)
            ->groupBy('partner_id')
            ->orderBy('sumamount', 'desc')
            ->get();

        return is_null($count) ? $datas : $datas->take($count);
    }

    public function partnerInvoicesPeriod($witch, $begin = null, $end = null, $partner = null): object
    {
        $sqlString = match($witch) {
            'H' => 'partner_id, concat(year(dated), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as period, sum(amount) as amount',
            'W' => 'partner_id, concat(year(dated), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as period, sum(amount) as amount',
            'Y' => 'partner_id, year(dated) as period, sum(amount) as amount',
        };

        return Invoices::with('partner')
            ->selectRaw($sqlString)
            ->whereBetween('dated', [$begin ?? Invoices::first()->dated, $end ?? Carbon::now()])
            ->where(function ($query) use ($partner) {
                if (is_null($partner)) {
                    $query->whereNotNull('partner_id');
                } else {
                    $query->where('partner_id', '=', $partner);
                }
            })
            ->groupBy('partner_id', 'period')
            ->get();
    }
}
