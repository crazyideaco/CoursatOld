<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DateResource;
class GroupResource extends JsonResource
{
   public function toArray($request)
    {
    if(auth()->user()->category_id == 1){
        $subject = $this->subject->name_ar;
      $course = $this->type->name_ar;
      $lect_name = $this->type->user ? $this->type->user->name : '';
      $lect_image = $this->type->user ? $this->type->user->image ? asset('uploads/'.$this->type->user->image) : '' :'';
      } else if(auth()->user()->category_id == 2){
        $subject = $this->subjectscollege->name_ar;
        $course = $this->typescollege->name_ar;
       $lect_name = $this->typescollege->doctor ? $this->typescollege->doctor->name : '';
      $lect_image = $this->typescollege->doctor ? $this->typescollege->doctor->image ? asset('uploads/'.$this->typescollege->doctor->image) : '' :'';
      }
       
  return [
       'id' => $this->id,
       'title' => $this->name_ar,
    'course' =>$course,
    'subject' => $subject,
    'number_of_students' => count($this->students),
    'lect_name' => $lect_name,
     'lect_image' => $lect_image,
    'dates' => DateResource::collection($this->days)
    
         ];
   }
}