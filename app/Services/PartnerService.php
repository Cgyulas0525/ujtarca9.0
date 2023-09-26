<?php

namespace App\Services;

use App\Models\Partners;

class PartnerService
{
    public function inactivation(): void
    {
        Partners::whereNotIn('id', function ($query) {
            return $query->from('invoices')->select('partner_id')->whereYear('dated', '>=', now()->subMonth(12)->toDateString())->get();
        })
            ->whereNotIn('partnertypes_id', [3, 5])
            ->where('active', 1)
            ->get()
            ->map(function ($partner) {
                $partner->active = 0;
                $partner->save();
                return $partner;
            });
    }
}
