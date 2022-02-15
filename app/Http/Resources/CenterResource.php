<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

           return [
           
           'name'=>$this->name,
           'email'=>$this->email,
           'code' => $this->code,
           'phone'=>$this->phone,
           'image' => ($this->image) ? asset('uploads/'. $this->image) : null,
			'printsplash' => ($this->printsplash) ? asset('uploads/'. $this->printsplash) : null,
           'city' => $this->city ? $this->city['city'] : null,
           'state' => $this->state ? $this->state['state'] : null,
           'address' => $this->address,
           'visitors' => $this->centerstudents()->count(),
           'decription' => $this->description
         
            
        ];
    }
}
