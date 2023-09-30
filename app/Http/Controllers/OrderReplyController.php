<?php
namespace App\Http\Controllers;

use App\Services\OrderService;

class OrderReplyController extends Controller
{
    public function orderReplay($id)
    {
        (new OrderService())->orderReplay($id);
    }
}
