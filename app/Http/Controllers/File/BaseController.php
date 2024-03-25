<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Services\File\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service){

        $this->service = $service;

    }

}
