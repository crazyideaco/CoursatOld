<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\paymentwayResource;
use App\Models\PaymentWay;
use App\Traits\ApiTrait;
use App\User;
use Illuminate\Http\Request;

class PaymentwayController extends Controller
{

    use ApiTrait;
    public function fetchPaymentWays()
    {
        $payments = [];
        $authuser = auth()->user();
        if (count($authuser->stdcenters) > 0) {
            $centers = $authuser->stdcenters;
            foreach ($centers as $key => $value) {
                array_push($payments, $value->paymentways);
                // $payments[] = $value->paymentway;
            }
            // $payments = $centersArray;
        } else {
            $payments = PaymentWay::get();
        }

        return  $this->dataResponse("payments collection", paymentwayResource::collection($payments));
    }
}
