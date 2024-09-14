<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class SessionController extends Controller
{
    public static function putSession(Request $request)
    {
        session([$request->variable => $request->value]);
        return session($request->variable);
    }

    public static function getSession(Request $request)
    {
        return session($request->variable);
    }
}
