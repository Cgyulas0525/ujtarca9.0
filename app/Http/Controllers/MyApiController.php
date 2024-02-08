<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Models\Products;
use App\Models\Quantities;
use Illuminate\Http\Request;
use Response;
use App\Models\Orderdetails;

class MyApiController extends Controller
{
    public static function partnerActiveFlag(Request $request)
    {
        $partner = Partners::find($request->get('id'));
        if (!empty($partner)) {
            $partner->active = $partner->active == 0 ? 1 : 0;
            $partner->save();
        }
        return back();
    }

    public function getProduct(Request $request)
    {
        return Response::json(Products::with('quantities')->find($request->get('id')));
    }

    public function getQuantity(Request $request)
    {
        return Response::json(Quantities::find($request->get('id')));
    }

    public function getOrderDetailQuantityName(Request $request): string
    {
        return Response::json(Orderdetails::find($request->get('id'))->quantities->name);
    }

}
