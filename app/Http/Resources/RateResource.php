<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $user = \App\User::where('id',$this->user_id)->first();
           return [
           'id' => $this->id,
           
            'rate'  =>(int)$this->rate,
            'comment' => $this->comment,
            'name'=> $user->name,
            'date' => $this->created_at->format('Y-m-d')
            
           
        
        ];
    }
}
