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

    public function newDeliveryByModal(Request $request)
    {
        $delivery = new Delivery();
        $delivery->delivery_number = $request->get('delivery_number');
        $delivery->date = $request->get('date');
        $delivery->location_id = $request->get('location_id');
        $delivery->description = $request->get('description');
        $delivery->save();
        $deliveries = Delivery::join('locations', 'location_id', '=', 'locations.id')->activeDeliveries()->selectRaw('deliveries.id, Concat(delivery_number, " " , locations.name, " - ", date) as deliveryFullName')->orderBy('delivery_number')->get();
        return Response::json(['message' => 'Kiszállítás hozzáadva', 'deliveries' => $deliveries, 'delivery' => $delivery]);

    }
}
