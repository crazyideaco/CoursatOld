<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CityResource;
class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
      $city= \App\City::where('state_id',$this->id)->get();
               
           return [
           'id'         => $this->id,
            'title' => $this->state,
            'cities'=>CityResource::collection($city),
           
        ];
    }
}
