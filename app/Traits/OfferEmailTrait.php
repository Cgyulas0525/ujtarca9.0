<?php

namespace App\Traits;

use App\Actions\OfferPdfAction;
use App\Events\SendMail;
use App\Models\Offerdetails;
use App\Models\Offers;
use App\Models\Partners;
use Event;

trait OfferEmailTrait
{
    public function offerEmail($id)
    {
        $offer = Offers::find($id);
        $owner = Partners::where('partnertypes_id', 5)->first();
        $partner = Partners::find($offer->partners_id);
        $details = Offerdetails::where('offers_id', $offer->id)->get();
        $offerPdfAction = new OfferPdfAction($offer, $owner, $partner, $details);
        $path = $offerPdfAction->handle();
        Event::dispatch(new SendMail($partner, $owner, $path, 'emails.pekaruMail', 'megrendelés!', 'új megrendelést küldött Önnek.'));
        return back();
    }
}
