<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CollegeResoure;
class UniversityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $colleges = \App\College::where('university_id',$this->id)->get();
       
           return [
            'id' => $this->id,
            'title' => $this->name_ar,
            'college' => CollegeResoure::collection($colleges)
            
        ];
    }
}