<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PartnerService;

class PartnerDeactivationController extends Controller
{
    private $partnerService;

    public function __construct(PartnerService $ps)
    {
        $this->partnerService = $ps;
    }

    /**
     * Partner Deactivation they not send invoice in last 12 months
     *
     * return
     */
    public function partnerDeactivation(): void
    {

        $this->partnerService->deactivation();

    }
}
