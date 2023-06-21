<?php

namespace App\Services;

use App\Models\Partners;

class PartnerService
{

    /**
     * Partners how not send invoice in last 12 month
     *
     * return void
     */
    public function deactivation() : void
    {

        Partners::whereNotIn('id', function($query) {
                    return $query->from('invoices')->select('partner_id')->whereYear('dated', '>=', date('Y', strtotime('today - 12 month')) )->get();
                })
                ->whereNotIn('partnertypes_id', [3, 5])
                ->where('active', 1)
                ->get()
                ->map(function($partner) {
                    $partner->active = 3;
                    $partner->save();
                    return $partner;
                });

    }

}
