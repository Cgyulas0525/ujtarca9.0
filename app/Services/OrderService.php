<?php

namespace App\Services;

use App\Enums\OrderTypeEnum;
use App\Models\Orderdetails;
use App\Models\Orders;
use Illuminate\Support\Facades\Config;

class OrderService
{
    /**
     * @param $id
     * @return int
     */
    public static function orderDetailsSum($id): int
    {
        return Orderdetails::where('orders_id', $id)->get()->sum('detailvalue');
    }

    /**
     * @param Orderdetails $orderdetails
     */
    public static function setOrderDetailsum(Orderdetails $orderdetails): void
    {
        $order = Orders::find($orderdetails->orders_id);
        $order->detailsum = self::orderDetailsSum($order->id);
        $order->save();
    }

    /**
     * @return string
     */
    public static function nextOrderNumber(): string
    {
        $maxOrder = ($_COOKIE['orderType'] == 'CUSTOMER') ? Orders::customerOrders()->get()->max('ordernumber') : Orders::supplierOrders()->get()->max('ordernumber');
        return (($_COOKIE['orderType'] == 'CUSTOMER') ? Config::get('OFFER_PREV') : Config::get('ORDER_PREV')) .
            (empty($maxOrder) ? '0001' : str_pad((int)(substr($maxOrder, 7)) + 1, 4, '0', STR_PAD_LEFT));
    }

    /**
     * @return string
     */
    public static function orderTypeByCookie(): string
    {

        return ($_COOKIE['orderType'] == 'CUSTOMER') ? OrderTypeEnum::CUSTOMER->description() : OrderTypeEnum::SUPPLIER->description();
    }
}
