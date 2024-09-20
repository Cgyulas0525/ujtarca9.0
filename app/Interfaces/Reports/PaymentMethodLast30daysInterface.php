<?php

namespace App\Interfaces\Reports;

interface PaymentMethodLast30daysInterface
{
    public function paymentMethodLast30days(): object;
}
