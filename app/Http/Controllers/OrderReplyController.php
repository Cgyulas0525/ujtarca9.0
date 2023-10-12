<?php
namespace App\Http\Controllers;

use App\Services\OrderReplayService;
use App\Classes\RedisClass;

class OrderReplyController extends Controller
{
    public function orderReplay($id): object
    {
        OrderReplayService::orderReplay($id);
        RedisClass::setexOrders();
        return back();
    }
}
