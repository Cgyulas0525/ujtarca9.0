<?php

namespace App\Actions\Average\DatabaseAction;

use DB;

class TableUpdateOrInsert
{

    public static function handle($table, $keyArray, $array): void
    {

        DB::table($table)->updateOrInsert($keyArray, $array);

    }

}
