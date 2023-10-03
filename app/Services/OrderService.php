<?php

namespace App\Services;

use App\Models\Orderdetails;
use Illuminate\Http\Request;
use App\Models\Orders;
use DB;
use Illuminate\Support\Facades\Config;

class OrderService
{
    public function nextOrderNumber($type): string
    {
        $maxOrder = ($type == 0) ? Orders::customerOrders()->get()->max('ordernumber') : Orders::supplierOrders()->get()->max('ordernumber');
        return (($type == 0) ? Config::get('OFFER_PREV') : Config::get('ORDER_PREV')) .
            (empty($maxOrder) ? '0001' : str_pad((int)(substr($maxOrder, 7)) + 1, 4, '0', STR_PAD_LEFT));
    }

    public function orderReplay($id)
    {
        $order = Orders::find($id);

        DB::beginTransaction();
        try {
            $newOrder = new Orders();

            $newOrder->ordernumber = $this->nextOrderNumber($order->ordertype);
            $newOrder->orderdate = now()->toDateString();
            $newOrder->partners_id = $order->partners_id;
            $newOrder->ordertype = $order->ordertype;
            $newOrder->created_at = now();

            $newOrder->save();

            foreach (Orderdetails::where('orders_id', $newOrder->id)->get() as $orderDetail) {
                $newOrderDetail = new OrderDetails();
                $newOrderDetail->orders_id = $newOrder->id;
                $newOrderDetail->products_id = $orderDetail->products_id;
                $newOrderDetail->quantities_id = $orderDetail->quantities_id;
                $newOrderDetail->value = $orderDetail->value;
                $newOrderDetail->save();
            }

            return view('orders.edit')->with('orders', $newOrder);
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
    }
}
