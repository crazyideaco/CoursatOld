<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PrimaryYearResource;
class LevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $years = \App\Year::where('stage_id',$this->id)->get();
       
           return [
            'id' => $this->id,
            'level' => $this->name_ar,
            'year' => PrimaryYearResource::collection($years)
        ];
    }
}
