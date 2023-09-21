<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PartnerService;

class PartnerDeactivationController extends Controller
{
    private $partnerService;

    public function __construct(PartnerService $ps)
    {
        $this->partnerService = $ps;
    }

    public function partnerDeactivation(): void
    {
        $this->partnerService->deactivation();
    }
}
