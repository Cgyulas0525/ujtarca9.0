<?php

namespace App\Services;

use App\Models\Delivery;

class DeliveryService
{

    const PREFIX = 'KISZ-';

    public static function nextDeliveryNumber(): string
    {
        $maxOrder = Delivery::get()->max('delivery_number');
        return (self::PREFIX . (empty($maxOrder) ? '0001' : str_pad((int)(substr($maxOrder, 7)) + 1, 4, '0', STR_PAD_LEFT)));
    }

}
