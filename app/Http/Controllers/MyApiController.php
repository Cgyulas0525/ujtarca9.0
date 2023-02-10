<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Models\Products;
use App\Models\Quantities;
use Illuminate\Http\Request;
use Response;

class MyApiController extends Controller
{
    public static function partnerActiveFlag(Request $request) {
        $partner = Partners::find($request->get('id'));
        $partner->active = $partner->active == 0 ? 1 : 0;
        $partner->save();

        return back();
    }

    public function getProduct(Request $request)
    {
        return Response::json( Products::find($request->get('id')) );
    }

    public function getQuantity(Request $request)
    {
        return Response::json( Quantities::find($request->get('id')) );
    }

    public function getOfferDetailQuantityName(Request $request)
    {
        return Response::json( Offerdetails::find($request->get('id'))->quantities->name);
    }

}
