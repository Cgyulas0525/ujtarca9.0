<?php
namespace App\Http\Controllers;

use App\Services\OrderReplayService;

class OrderReplyController extends Controller
{
    public function orderReplay($id): object
    {
        OrderReplayService::orderReplay($id);
        return back();
    }
}
