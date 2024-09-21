<?php

namespace App\Classes\Stackeds;

class StackSumPercentClass
{
    public function getSumPercent(string $model, string $field): int
    {
        $model_name = 'App\Models\\' . $model;
        if ($model == 'Yearstacked') {
            return Round($model_name::all()->sum($field) / (($model_name::all()->sum('revenue') / 100)), 0);
        } elseif ($model == 'Monthstacked') {
            $query = $model_name::orderBy('year', 'desc')->orderBy('month', 'desc')->get()->take(12);
            return Round($query->sum($field) / ($query->sum('revenue') / 100), 0);
        } else {
            return 0;
        }
    }
}
