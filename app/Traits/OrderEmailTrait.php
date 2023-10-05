<?php

namespace App\Traits;

use App\Actions\OrderPdfAction;
use App\Events\SendMail;
use App\Models\Orderdetails;
use App\Models\Orders;
use App\Models\Partners;
use Event;

trait OrderEmailTrait
{
    public function orderEmail($id)
    {
        $order = Orders::find($id);
        $owner = Partners::where('partnertypes_id', 5)->first();
        $partner = Partners::find($order->partners_id);
        $details = Orderdetails::where('orders_id', $order->id)->get();
        $orderPdfAction = new OrderPdfAction($order, $owner, $partner, $details);
        $path = $orderPdfAction->handle();
        Event::dispatch(new SendMail($partner, $owner, $path, 'emails.pekaruMail', 'megrendelés!', 'új megrendelést küldött Önnek.'));
        return back();
    }
}
