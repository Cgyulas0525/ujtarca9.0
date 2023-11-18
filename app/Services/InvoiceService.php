<?php

namespace App\Services;

use App\Models\Invoices;
use Carbon\Carbon;
use App\Classes\BestSupplierClass;
use App\Classes\PartnerInvioicePeriodClass;

class InvoiceService
{
    public function partnerInvoicesPeriod(PartnerInvioicePeriodClass $pip): object
    {
        $sqlString = match($pip->witch) {
            'H' => 'partner_id, concat(year(dated), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as period, sum(amount) as amount',
            'W' => 'partner_id, concat(year(dated), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as period, sum(amount) as amount',
            'Y' => 'partner_id, year(dated) as period, sum(amount) as amount',
        };

        return Invoices::with('partner')
            ->selectRaw($sqlString)
            ->whereBetween('dated', [$pip->begin ?? Invoices::first()->dated, $pip->end ?? Carbon::now()])
            ->where(function ($query) use ($pip) {
                is_null($pip->partner) ? $query->whereNotNull('partner_id') : $query->where('partner_id', '=', $pip->partner);
            })
            ->groupBy('partner_id', 'period')
            ->get();
    }

    public function bestSupplier(BestSupplierClass $bestSupplierClass): object
    {
        $datas = Invoices::with('partner')
            ->selectRaw('sum(amount) as sumamount, sum(1) as invoiceCount, partner_id')
            ->where( function($query) use ($bestSupplierClass) {
                is_null($bestSupplierClass->year) ? $query->whereNotNull('dated') : $query->whereRaw('year(dated) =' . $bestSupplierClass->year);
            })
            ->groupBy('partner_id')
            ->orderBy('sumamount', 'desc')
            ->get();

        return is_null($bestSupplierClass->count) ? $datas : $datas->take($bestSupplierClass->count);
    }

}

