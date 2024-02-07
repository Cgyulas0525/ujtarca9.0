<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Quantities;

class QuantityController extends Controller
{
    public function getQuantity(Request $request)
    {
        $quantity = Quantities::find($request->input('id'));
        return Response::json(['quantity' => $quantity]);
    }
}
