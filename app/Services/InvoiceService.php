<?php

namespace App\Services;

use App\Models\Invoices;

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
}
