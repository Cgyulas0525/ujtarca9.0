<?php

namespace App\Classes\Api\Inc;

class baseTables
{
    public $array = [];

    public function __construct() {
        array_push($this->array, 'userstatuses' );
        array_push($this->array, 'settlements' );
        array_push($this->array, 'users' );
        array_push($this->array, 'migrations' );
        array_push($this->array, 'failed_jobs' );
    }

    public function getArray() {
        return $this->array;
    }
}

