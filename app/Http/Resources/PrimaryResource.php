<?php

namespace App\Http\Resources;
use App\Http\Resources\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LevelResource;
class PrimaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $stages = \App\Stage::all();
       
           return [
       
            'level' => LevelResource::collection($stages)
        ];
    }
}
