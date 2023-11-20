<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReelResource;
use App\Models\Reel;
use App\Models\Teacher\Teacher;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class AppReelController extends Controller
{
    use ApiTrait;
    public function fetch_reels(Request $request)
    {
        try {

            $user = auth()->user();
            $reels = Reel::whereHas("informations", function ($query) use ($user) {
                $query->when($user->category_id == 1, function ($q) use ($user) {
                    $q->whereYearId($user->year_id);
                })->when($user->category_id == 2, function ($q) use ($user) {
                    $q->whereDivisionId($user->division_id);
                });
            })->get();


            //response

            $msg = "fetch_reels";
            $response =  ReelResource::collection($reels);

            return $this->dataResponse($msg, $response, 200);
        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
