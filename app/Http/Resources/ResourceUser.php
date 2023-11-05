<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceUser extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
       
      $state= \App\State::where('id',$this->state_id)->first();
    
      if($state ==null){
          $state=null;
      }else{
      $state= $state->name;
          
      }
      
      $city= \App\City::where('id',$this->city_id)->first();
      if($city==null){
          $city=null;
      }else{
          $city= $city->name;
          
      }
      $subject= \App\Subject::where('id',$this->subject_id	)->first();
      if($subject==null){
          $subject=null;
      }else{
          $subject=$subject->name ;

      }
        
           return [
            'id'         => $this->id,
            'user_name' => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,              
            'state'      => $state,
            'city'    => $city,
            'subject'=>$subject,
            'address'=>$this->address,
            "latitude"=>$this->latitude,
            "longitude"=>$this->longitude,
            'is_student'=>$this->is_student,
            'image'=>$this->image,
            'description'=>$this->description,
            'code'=>$this->code,
           'api_token'  => $this->api_token,
       

        ];
    }
}
