<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Response;

class ModalDeliveryController extends Controller
{
    public function getDeliveryByDateAndLocation(Request $request)
    {
        $delivery = Delivery::where('date', $request->get('date'))
                            ->where('location_id', $request->get('location_id'))
                            ->first();
        return !empty($delivery) ? Response::json($delivery) : Response::json(null);

    }
}
