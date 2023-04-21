<?php

namespace App\Services;

use App\Models\ClosureCimlets;
use Carbon\Carbon;


class ClosureCimletInsert
{
    private $cimletId;
    private $closureId;

    /**
     * @return mixed
     */
    public function __construct($cimletId, $closureId) {
        $this->cimletId = $cimletId;
        $this->closureId = $closureId;
    }

    public function handle() {
        ClosureCimlets::insert([
            'closures_id' => $this->closureId,
            'cimlets_id' => $this->cimletId,
            'value' => 0,
            'created_at' => Carbon::now()
        ]);
    }
}
