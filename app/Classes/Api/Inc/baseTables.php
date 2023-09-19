<?php

namespace App\Classes\Api\Inc;

class baseTables
{
    public $array = [];

    public function __construct() {
        $this->array = [
            'userstatuses',
            'settlements',
            'users',
            'migrations',
            'failed_jobs',
        ];
    }

    public function getArray() {
        return $this->array;
    }
}

