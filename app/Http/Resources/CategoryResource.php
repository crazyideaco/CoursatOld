<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
          $user_year= \auth()->user()->year_id;
      
          $user_latitude= \auth()->user()->latitude;
          $user_longitude= \auth()->user()->longitude;

      $max_user_latitude = $user_latitude + 0.35;
      $min_user_latitude = $user_latitude - 0.35;
                
      $max_user_longitude = $user_longitude + 0.35;
      $min_user_longitude = $user_longitude - 0.35;
             
               $allclosetid= \App\User::where('is_student',2)->where('latitude', '>', $min_user_latitude)->where('latitude','<',$max_user_latitude)->where('longitude','>',$min_user_longitude)->where('longitude','<',$max_user_longitude)->pluck('id');
            
              
                
              $closet= VideoResource::collection(\App\Video::whereIn('user_id',$allclosetid)->where('year_id',$user_year)->where('subject_id',$this->id)->get());   

               
                  $new= VideoResource::collection(\App\Video::where('year_id',$user_year)->where('subject_id',$this->id)->latest()->take(10)->get());  
                  
              
        
           return [
           'id'         => $this->id,
           
            'name' => $this->name,
           'closet'=>$closet,
            'new'=>$new,
        ];
    }
}
