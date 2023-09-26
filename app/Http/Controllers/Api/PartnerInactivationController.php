<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PartnerService;

class PartnerInactivationController extends Controller
{
    private $partnerService;

    public function __construct(PartnerService $ps)
    {
        $this->partnerService = $ps;
    }

    public function partnerInactivation(): void
    {
        $this->partnerService->inactivation();
    }
}
