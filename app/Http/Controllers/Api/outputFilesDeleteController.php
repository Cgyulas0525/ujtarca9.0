<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Classes\Api\fileDeleteClass;

class outputFilesDeleteController extends Controller
{
    public function deleteOutputFiles(): void
    {
        (new fileDeleteClass())->deleteOutputFiles();
    }
}
