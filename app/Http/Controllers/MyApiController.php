<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;

class MyApiController extends Controller
{
    public static function partnerActiveFlag(Request $request) {
        $partner = Partners::find($request->get('id'));
        $partner->active = $partner->active == 0 ? 1 : 0;
        $partner->save();

        return back();
    }
}
