<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Resources\OfferResource;
use App\Tag;
use App\Offer;

use App\Http\Controllers\Controller;
class TagController extends Controller
{
  public function tags(){
    $tags = Tag::all();
    return response()->json([
      'status' => true,
      'message' => 'all tags',
      'data' => TagResource::collection($tags)
    ]);
  }public function centeroffers(){
    $user_ids = auth()->user()->centerstudents->pluck("id");
    $offers = Offer::whereIn("id",$user_ids)->get();
      return response()->json([
      'status' => true,
      'message' => 'center offers',
      'data' => OfferResource::collection($offers)
    ]);
  }
  }