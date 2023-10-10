<?php

namespace App\Services;

use App\Models\Orderdetails;
use App\Models\Orders;
use DB;
use App\Services\OrderService;

class OrderReplayService
{
    public static function newOrder(Orders $order): Orders
    {
        $newOrder = new Orders();
        $newOrder->ordernumber = OrderService::nextOrderNumber($order->ordertype->value);
        $newOrder->orderdate = now()->toDateString();
        $newOrder->partners_id = $order->partners_id;
        $newOrder->ordertype = $order->ordertype;
        $newOrder->detailsum = $order->detailsum;
        $newOrder->created_at = now();
        $newOrder->save();

        return $newOrder;
    }

    public static function newOrderDetails($newOrder): void
    {
        foreach (Orderdetails::where('orders_id', $newOrder->id)->get() as $orderDetail) {
            $newOrderDetail = new OrderDetails();
            $newOrderDetail->orders_id = $newOrder->id;
            $newOrderDetail->products_id = $orderDetail->products_id;
            $newOrderDetail->quantities_id = $orderDetail->quantities_id;
            $newOrderDetail->value = $orderDetail->value;
            $newOrderDetail->save();
        }
    }

    /**
     * @param $id
     * @return object
     * @throws \Throwable
     */
    public static function orderReplay($id): object
    {
        $order = Orders::find($id);
        if (!empty($order)) {
            DB::beginTransaction();
            try {
                $newOrder = self::newOrder($order);
                self::newOrderDetails($newOrder);
                return view('orders.edit')->with('orders', $newOrder);
            } catch (\Exception $e) {
                DB::rollBack();
                return back();
            }
        } else {
            return back();
        }
    }

}
