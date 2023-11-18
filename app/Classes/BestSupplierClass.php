<?php

namespace App\Classes;

class BestSupplierClass
{
    public $year, $count;

    public function __construct(?int $year = null,  ?int $count = null)
    {
        $this->year = $year;
        $this->count = $count;
    }
}
