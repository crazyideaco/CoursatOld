<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SectionResource;

class CollegeResoure  extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $sections = \App\Division::where('college_id',$this->id)->get();
       
           return [
            'id' => $this->id,
            'title' => $this->name_ar,
            'sections' => SectionResource::collection($sections)
            
        ];
    }
}