<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideogeneralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
          if($this->paid == 1){
            $allow = 1;
        }else if(auth()->user()->stucourses->pluck('id')->contains($this->course_id)){
            $allow = 1;
        }else{
            $allow = 0;
        }   if($this->center){
           $center_image = asset('uploads/'.$this->center['image']);
       }else{
           $center_image = asset('uploads/'.$this->user['image']);
       }if($this->center){
           $center_name = $this->center['name'];
       }else{
          $center_name = $this->user['name']; 
       }
           return [
           'id'         => $this->id,
           'video_url' => $this->url_link ?? null,
            'image'=> asset('uploads/'. $this->image),
            // 'subject'=>$this->subjectscollege['name_ar'],
       /*     'description'=>$this->description_ar,
			    'lecturer' => $this->user['name'],
           'lecturer_id' => $this->user_id,
           'posted_by' => $center_name,
           'posted_by_image' =>$center_image, 
            'pdf' => asset('uploads/'.$this->pdf),*/
            'name' => $this->name_ar,
			 'allow' => $allow,
              'mintues' => $this->seconds > 0 ? intval($this->seconds / 60) : 0,
        ];
    }
}
