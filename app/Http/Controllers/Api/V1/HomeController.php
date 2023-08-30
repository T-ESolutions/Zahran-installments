<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponseTrait;

class HomeController extends Controller
{
    use BaseApiResponseTrait;

    public function index()
    {
        return 'api';
    }
}
