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

            $user = auth()->user();
            $reels = Reel::whereHas("information", function ($query) use ($user) {
                $query->when($user->category_id == 1, function ($q) use ($user) {
                    $q->where('stage_id',$user->stage_id)
                    ->orWhere('year_id',$user->year_id)
                    ->orWhere('subject_id',$user->subject_id);
                })->when($user->category_id == 2, function ($q) use ($user) {
                    $q->where('university_id',$user->university_id)
                    ->orWhere('college_id',$user->college_id)
                    ->orWhere('division_id',$user->division_id)
                    ->orWhere('section_id',$user->section_id);
                });
            })->get();


            //response

            $msg = "fetch_reels";
            $response =  ReelResource::collection($reels);

            return $this->dataResponse($msg, $response, 200);
       
    }
}
