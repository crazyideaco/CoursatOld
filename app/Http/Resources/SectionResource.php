<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CollegeYearResource;
class SectionResource  extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $years = \App\Section::where('division_id',$this->id)->get();
       
           return [
            'id' => $this->id,
            'title' => $this->name_ar,
            'years' => CollegeYearResource::collection($years)
            
        ];
    }
}