<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class GeneralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->image){
            $image = asset('uploads/'.$this->image);
        }else{
            $image = null;
        }
       
           return [
           'id'  => $this->id,
           'image' => $image,
           'title' => $this->name_ar,
        ];
    }
}