<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\paymentwayResource;
use App\Models\PaymentWay;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class PaymentwayController extends Controller
{

use ApiTrait;
    public function fetchPaymentWays () {
        $payments= PaymentWay::get();
        return  $this->dataResponse("payments collection",paymentwayResource::collection($payments));
    }
}
