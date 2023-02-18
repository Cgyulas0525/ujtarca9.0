<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\Offerdetails;

class OfferServiceController extends Controller
{
    public static function nextOfferNumber() {

        $maxOffer = Offers::all()->max('offernumber');
        return empty($maxOffer) ? env('OFFER_PREV') . '-' . '0001' : str_pad(intval(substr($maxOffer, 5)) + 1, 4, '0', STR_PAD_LEFT);

    }

    public static function offerReplay($id) {

        $offer = Offers::find($id);
        $offerdetails = Offersdetails::where('offers_id', $offer->id)->get();

        $nextOfferNumber = self::nextOfferNumber();
        $newOffer = new Offers();

        $offerId = $newOffer->insertGetId([
            $newOffer['offernumber'] => $nextOfferNumber,
            $newOffer['offerdate'] = \Carbon\Carbon::now(),
            $newOffer['partners_id'] = $offer->partners_id,
            $newOffer['created_at'] = \Carbon\Carbon::now()
        ]);

        foreach ( $offerdetails as $offerDetail ) {
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
