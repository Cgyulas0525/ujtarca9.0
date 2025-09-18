<?php

namespace App\Services;

use App\Models\Monthstacked;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ForecastService
{
    public function forecastNext12Months(): Collection
    {
        $data = $this->loadHistoricalData();
        if ($data->count() < 2) {
            return $this->repeatLastKnown($data);
        }

        [$cagrRevenue, $cagrSpend, $revenueReg, $spendReg, $last, $lastIndex] = $this->prepareGrowthModels($data);

        return $this->generateForecast(
            $cagrRevenue,
            $cagrSpend,
            $revenueReg,
            $spendReg,
            $last,
            $lastIndex
        );
    }

    private function loadHistoricalData(): Collection
    {
        $now = Carbon::now();
        $currentYear = (int)$now->format('Y');
        $currentMonth = (int)$now->format('m');

        return Monthstacked::orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->reject(fn($r) => (int)$r->year === $currentYear && (int)$r->month === $currentMonth)
            ->values();
    }

    private function repeatLastKnown(Collection $data): Collection
    {
        $forecast = collect();
        $last = $data->last();
        $start = Carbon::now()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            $date = (clone $start)->addMonths($i);
            $forecast->push([
                'year' => $date->year,
                'month' => $date->month,
                'year_month' => $this->formatYearMonth($date->year, $date->month),
                'revenue' => $last?->revenue ?? 0,
                'spend' => $last?->spend ?? 0,
                'result' => ($last?->revenue ?? 0) - ($last?->spend ?? 0),
            ]);
        }

        return $forecast;
    }

    private function prepareGrowthModels(Collection $data): array
    {
        $first = $data->first();
        $last = $data->last();

        $years = ($last->year + ($last->month - 1) / 12)
            - ($first->year + ($first->month - 1) / 12);

        $cagrRevenue = $this->calculateCagr($first->revenue, $last->revenue, $years);
        $cagrSpend   = $this->calculateCagr($first->spend, $last->spend, $years);

        $revenueReg = $cagrRevenue === null ? $this->linearRegression($data, 'revenue') : null;
        $spendReg   = $cagrSpend === null   ? $this->linearRegression($data, 'spend')   : null;

        return [$cagrRevenue, $cagrSpend, $revenueReg, $spendReg, $last, $data->count() - 1];
    }

    private function calculateCagr($first, $last, $years): ?float
    {
        if ($years <= 0 || $first <= 0 || $last <= 0) {
            return null;
        }
        return pow($last / $first, 1 / $years) - 1;
    }

    private function linearRegression(Collection $data, string $field): array
    {
        $n = $data->count();
        $sumT = $sumY = $sumTSq = $sumTY = 0.0;

        $data->values()->each(function ($r, $i) use (&$sumT, &$sumY, &$sumTSq, &$sumTY, $field) {
            $t = $i;
            $y = (float)$r->{$field};
            $sumT += $t;
            $sumY += $y;
            $sumTSq += $t * $t;
            $sumTY += $t * $y;
        });

        $den = ($n * $sumTSq - $sumT * $sumT);
        if (abs($den) < 1e-9) {
            return ['a' => $sumY / max(1, $n), 'b' => 0.0];
        }

        $b = ($n * $sumTY - $sumT * $sumY) / $den;
        $a = ($sumY - $b * $sumT) / $n;

        return ['a' => $a, 'b' => $b];
    }

    private function generateForecast(
        ?float $cagrRevenue,
        ?float $cagrSpend,
        ?array $revenueReg,
        ?array $spendReg,
               $last,
        int $lastIndex
    ): Collection {
        $forecast = collect();
        $start = Carbon::now()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            $date = (clone $start)->addMonths($i);

            $revenue = $this->forecastValue($cagrRevenue, $revenueReg, $last->revenue, $lastIndex, $i);
            $spend   = $this->forecastValue($cagrSpend, $spendReg, $last->spend, $lastIndex, $i);

            $forecast->push([
                'year' => $date->year,
                'month' => $date->month,
                'year_month' => $this->formatYearMonth($date->year, $date->month),
                'revenue' => $revenue,
                'spend' => $spend,
                'result' => $revenue - $spend,
                'resultPercent' => $revenue > 0
                    ? round((($revenue - $spend) / $revenue) * 100, 2)
                    : 0,
            ]);
        }

        return $forecast;
    }

    private function forecastValue(?float $cagr, ?array $reg, float $lastValue, int $lastIndex, int $i): int
    {
        if ($cagr !== null) {
            $monthlyGrowth = pow(1 + $cagr, 1 / 12);
            return max(0, (int)round($lastValue * pow($monthlyGrowth, $i + 1)));
        }

        if ($reg !== null) {
            $t = $lastIndex + 1 + $i;
            return max(0, (int)round($reg['a'] + $reg['b'] * $t));
        }

        return 0;
    }

    private function formatYearMonth(int $year, int $month): string
    {
        return $year . '.' . str_pad($month, 2, '0', STR_PAD_LEFT);
    }

    public function getChartData(string $field)
    {
        $allData = Monthstacked::orderBy('year')->orderBy('month')->get();
        $forecastData = (new \App\Services\ForecastService())->forecastNext12Months();

        // utolsó 12 hónap tényleges
        $last12 = $allData->slice(-12)->values();
        // az azt megelőző 12 hónap
        $prev12 = $allData->slice(-24, 12)->values();

        // készítünk üres 12 elemű tömböket havonként
        $months = range(1,12);
        $series = [
            'prev12' => array_fill(0, 12, 0),
            'last12' => array_fill(0, 12, 0),
            'forecast' => array_fill(0, 12, 0),
        ];

        // előző 12 hónap adat feltöltése
        foreach ($prev12 as $r) {
            $monthIndex = ((int)$r->month - 1); // 0..11
            $series['prev12'][$monthIndex] += $r->$field;
        }

        // utolsó 12 hónap adat
        foreach ($last12 as $r) {
            $monthIndex = ((int)$r->month - 1);
            $series['last12'][$monthIndex] += $r->$field;
        }

        // forecast
        foreach ($forecastData as $r) {
            $monthIndex = ((int)$r['month'] - 1);
            $series['forecast'][$monthIndex] += $r[$field];
        }

        return [
            'categories' => ['01','02','03','04','05','06','07','08','09','10','11','12'],
            'series' => [
                ['name' => 'Előző év', 'data' => $series['prev12']],
                ['name' => 'Tavaly', 'data' => $series['last12']],
                ['name' => 'Terv', 'data' => $series['forecast']],
            ]
        ];
    }
}
