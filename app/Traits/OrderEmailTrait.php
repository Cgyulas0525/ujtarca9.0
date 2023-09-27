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
        $offer = Orders::find($id);
        $owner = Partners::where('partnertypes_id', 5)->first();
        $partner = Partners::find($offer->partners_id);
        $details = Orderdetails::where('orders_id', $offer->id)->get();
        $offerPdfAction = new OrderPdfAction($offer, $owner, $partner, $details);
        $path = $offerPdfAction->handle();
        Event::dispatch(new SendMail($partner, $owner, $path, 'emails.pekaruMail', 'megrendelés!', 'új megrendelést küldött Önnek.'));
        return back();
    }
}
