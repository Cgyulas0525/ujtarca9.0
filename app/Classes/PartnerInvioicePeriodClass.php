<?php

namespace App\Classes;

class PartnerInvioicePeriodClass
{
    public $witch, $begin, $end, $partner;

    public function __construct($witch, $begin = null, $end = null, $partner = null)
    {
        $this->witch = $witch;
        $this->begin = $begin;
        $this->end = $end;
        $this->partner = $partner;
    }
}
