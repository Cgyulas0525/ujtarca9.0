<?php

namespace App\Services;

use App\Models\Closures;

class ClosuresService
{
    public function yearsOfClosures(): array
    {
        return Closures::selectRaw('year(closuredate) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year', 'year')
            ->toArray();
    }

    public function closuresYearsDDDW(): array
    {
        return [" "] + $this->yearsOfClosures();
    }
}
