<?php

namespace App\Actions\Average\DatabaseAction;

class TableUpdateOrInsert
{
    public static function handle($table, $keyArray, $array): void
    {
        'App\Models\\'.$table::updateOrInsert($keyArray, $array);
    }
}
