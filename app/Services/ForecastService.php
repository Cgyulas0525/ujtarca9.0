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

        $seasonalityRevenue = $this->calculateSeasonality($data, 'revenue');
        $seasonalitySpend   = $this->calculateSeasonality($data, 'spend');

        return $this->generateForecast(
            $cagrRevenue,
            $cagrSpend,
            $revenueReg,
            $spendReg,
            $last,
            $lastIndex,
            $seasonalityRevenue,
            $seasonalitySpend
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

    private function calculateSeasonality(Collection $data, string $field): array
    {
        $seasonality = [];
        $yearGroups = $data->groupBy('year');
        $ratios = [];

        foreach ($yearGroups as $year => $records) {
            $yearAvg = $records->avg($field);
            if ($yearAvg <= 0) {
                continue;
            }

            foreach ($records->groupBy('month') as $month => $monthRecords) {
                $monthAvg = $monthRecords->avg($field);
                $ratios[$month][] = $monthAvg / $yearAvg;
            }
        }

        for ($m = 1; $m <= 12; $m++) {
            if (!empty($ratios[$m])) {
                $seasonality[$m] = array_sum($ratios[$m]) / count($ratios[$m]);
            } else {
                $seasonality[$m] = 1.0;
            }
        }

        return $seasonality;
    }

    private function generateForecast(
        ?float $cagrRevenue,
        ?float $cagrSpend,
        ?array $revenueReg,
        ?array $spendReg,
               $last,
        int $lastIndex,
        array $seasonalityRevenue,
        array $seasonalitySpend
    ): Collection {
        $forecast = collect();
        $start = Carbon::now()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            $date = (clone $start)->addMonths($i);

            $revenue = $this->forecastValue(
                $cagrRevenue, $revenueReg, $last->revenue, $lastIndex, $i, $seasonalityRevenue, $date->month
            );
            $spend = $this->forecastValue(
                $cagrSpend, $spendReg, $last->spend, $lastIndex, $i, $seasonalitySpend, $date->month
            );

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

    private function forecastValue(
        ?float $cagr,
        ?array $reg,
        float $lastValue,
        int $lastIndex,
        int $i,
        array $seasonality,
        int $month
    ): int {
        $base = 0.0;

        if ($cagr !== null) {
            $monthlyGrowth = pow(1 + $cagr, 1 / 12);
            $base = $lastValue * pow($monthlyGrowth, $i + 1);
        } elseif ($reg !== null) {
            $t = $lastIndex + 1 + $i;
            $base = $reg['a'] + $reg['b'] * $t;
        }

        $factor = $seasonality[$month] ?? 1.0;

        return max(0, (int)round($base * $factor));
    }

    private function formatYearMonth(int $year, int $month): string
    {
        return $year . '.' . str_pad($month, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Javított getChartData: chronological categories (year_month), a három sorozat egymás után: prev12, last12, forecast.
     * Hiányzó értékeket null-lal töltünk (chartban gap lesz). Ha 0-t szeretnél, cseréld le a null-okat 0-ra.
     */
    public function getChartData(string $field, bool $useNullForMissing = true)
    {
        $allData = Monthstacked::orderBy('year')->orderBy('month')->get();
        $forecastData = $this->forecastNext12Months();

        $last12 = $allData->slice(-12)->values();
        $prev12 = $allData->slice(-24, 12)->values();

        $months = $forecastData->pluck('month')->all();

        $prevSeries = [];
        $lastSeries = [];
        $forecastSeries = [];

        foreach ($months as $m) {
            $prevVal = $prev12->firstWhere('month', $m)?->{$field} ?? ($useNullForMissing ? null : 0);
            $lastVal = $last12->firstWhere('month', $m)?->{$field} ?? ($useNullForMissing ? null : 0);
            $forecastVal = collect($forecastData)->firstWhere('month', $m)[$field] ?? ($useNullForMissing ? null : 0);

            $prevSeries[] = $prevVal;
            $lastSeries[] = $lastVal;
            $forecastSeries[] = $forecastVal;
        }

        return [
            'categories' => array_map(fn($m) => str_pad($m, 2, '0', STR_PAD_LEFT), $months),
            'series' => [
                ['name' => 'Előző év', 'data' => $prevSeries],
                ['name' => 'Tavaly',    'data' => $lastSeries],
                ['name' => 'Terv',      'data' => $forecastSeries],
            ]
        ];
    }
}
