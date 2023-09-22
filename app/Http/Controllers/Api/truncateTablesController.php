<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Classes\Api\truncateTablesClass;

class truncateTablesController extends Controller
{
    public function truncateAllTables(): void
    {
        (new truncateTablesClass())->truncateTables();
    }
}
