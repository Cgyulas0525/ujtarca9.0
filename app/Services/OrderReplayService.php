<?php

namespace App\Services;

use App\Models\Orderdetails;
use App\Models\Orders;
use DB;

class OrderReplayService
{
    /**
     * Create new orders record
     *
     * @param Orders $order
     * @return Orders
     */
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

    /**
     * Create new orderdetails records
     *
     * @param $id
     * @param $newOrder
     */
    public static function newOrderDetails(Orders $order, $newOrder): void
    {

        foreach (Orderdetails::whereBelongsTo($order)->get() as $orderDetail) {
            $newOrderDetail = new OrderDetails();
            $newOrderDetail->orders_id = $newOrder->id;
            $newOrderDetail->products_id = $orderDetail->products_id;
            $newOrderDetail->quantities_id = $orderDetail->quantities_id;
            $newOrderDetail->value = $orderDetail->value;
            $newOrderDetail->created_at = now();
            $newOrderDetail->save();
        }
    }

    /**
     * Replay orders record
     *
     * @param $id
     * @return object
     * @throws \Throwable
     */
    public static function orderReplay(int $id): object
    {
        $order = Orders::find($id);
        if (!empty($order)) {
            DB::beginTransaction();
            try {
                $newOrder = self::newOrder($order);
                self::newOrderDetails($order, $newOrder);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back();
            }
        } else {
            return back();
        }
        return back();
    }

}
