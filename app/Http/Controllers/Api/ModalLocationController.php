<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Location;


class ModalLocationController extends Controller
{
    public function getLocationByName(Request $request)
    {
        $location = Location::where('name', $request->get('name'))->first();
        return !empty($location) ? Response::json($location) : Response::json(null);

    }

    public function newLocationByModal(Request $request)
    {
        $location = new Location();
        $location->name = $request->get('name');
        $location->postcode = $request->get('postcode');
        $location->settlement_id = $request->get('settlement_id');
        $location->address = $request->get('address');
        $location->save();
        $locations = Location::all();
        return Response::json(['message' => 'Cím hozzáadva', 'locations' => $locations, 'location' => $location]);

    }

}
