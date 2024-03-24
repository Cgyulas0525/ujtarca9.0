<?php

namespace App\Actions\Average\DatabaseAction;

class TableUpdateOrInsert
{
    public static function handle($table, $keyArray, $array): void
    {
        $model = 'App\Models\\'.$table;
        $model::updateOrInsert($keyArray, $array);
    }
}
