<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\Orders;
use App\Models\Offerdetails;
use App\Classes\ConstansClass;

class OfferService
{
    public static function nextOfferNumber(): string
    {
        $maxOffer = Offers::all()->max('offernumber');
        return ConstansClass::OFFER_PREV . (empty($maxOffer) ? '0001' : str_pad((int)(substr($maxOffer, 6)) + 1, 4, '0', STR_PAD_LEFT));
    }

    public static function nextOrderNumber(): string
    {
        $maxOrder = Orders::all()->max('ordernumber');
        return ConstansClass::ORDER_PREV . (empty($maxOrder) ? '0001' : str_pad((int)(substr($maxOrder, 7)) + 1, 4, '0', STR_PAD_LEFT));
    }

    public static function offerReplay($id)
    {
        $offer = Offers::find($id);
        $offerdetails = Offerdetails::where('offers_id', $offer->id)->get();
        $nextOfferNumber = self::nextOfferNumber();
        $newOffer = new Offers();
        $offerId = $newOffer->insertGetId([
            $newOffer['offernumber'] => $nextOfferNumber,
            $newOffer['offerdate'] = \Carbon\Carbon::now(),
            $newOffer['partners_id'] = $offer->partners_id,
            $newOffer['created_at'] = \Carbon\Carbon::now()
        ]);
        foreach ($offerdetails as $offerDetail) {
            $newOfferDetail = new OffersDetail();
            $newOfferDetail->insert([
                $newOfferDetail['offers_id'] => $offerId,
                $newOfferDetail['products_id'] => $offerDetail->products_id,
                $newOfferDetail['quantities_id'] => $offerDetail->quantities_id,
                $newOfferDetail['value'] => $offerDetail->value
            ]);
        }
        $offer = Offers::find($offerId);
        return view('offers.edit')->with('offers', $offer);
    }
}
