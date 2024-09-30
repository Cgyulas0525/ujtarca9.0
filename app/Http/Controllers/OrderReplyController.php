<?php
namespace App\Http\Controllers;

use App\Services\OrderReplayService;

class OrderReplyController extends Controller
{
    protected $orderReplayService;

    public function __construct(OrderReplayService $orderReplayService)
    {
        $this->orderReplayService = $orderReplayService;
    }

    public function orderReplay($id): object
    {
        $this->orderReplayService->orderReplay($id);
        return back();
    }
}
