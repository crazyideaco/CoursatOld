<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointController extends Controller
{
   public function get_points(){
    $msg = "your points";
       return response()->json([
           "status" => true,
           "message" => $msg,
           "points" => intval(auth()->user()->points)
       ]);
   }
}