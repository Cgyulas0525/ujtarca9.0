<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use Illuminate\Http\Request;

class ModalPartnerController extends Controller
{
    public function newPartnerByModal(Request $request)
    {
        $partner = new Partners();
        $partner->name = $request->input('name');
        $partner->postcode = $request->input('postcode');
        $partner->settlement_id = $request->input('settlement_id');
        $partner->address = $request->input('address');
        $partner->email = $request->input('email');
        $partner->partnertypes_id = $request->input('partner_types_id');
        $partner->save();
        $partners = Partners::all();
        return response()->json(['message' => 'Partner hozzáadva', 'partners' => $partners, 'partner' => $partner]);
    }

    public function getPartnerByName(Request $request)
    {
        $partner = Partners::where('name', $request->get('name'))->first();
        if (!empty($partner)) {
            return Response::json($partner->id);
        }
        return Response::json(null);
    }

}
