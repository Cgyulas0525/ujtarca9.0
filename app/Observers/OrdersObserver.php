<?php

namespace App\Observers;

use App\Models\Orders;
use App\Models\Orderdetails;

class OrdersObserver
{
    /**
     * Handle the Orders "deleting" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function deleting(Orders $orders)
    {
        Orderdetails::whereBelongsTo($orders)->delete();
    }
}
