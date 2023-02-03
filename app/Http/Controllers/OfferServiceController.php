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
}
