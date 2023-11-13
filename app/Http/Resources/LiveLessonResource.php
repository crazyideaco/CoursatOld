<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class LiveLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      if(auth()->user()->category_id == 1){
      $course = $this->type;
  if($course->user){
    $name = $course->user->name;
  }
    }else if(auth()->user()->category_id == 2){
        $course = $this->typescollege;
  if($course->doctor){
    $name = $course->doctor->name;
  }
  
} elseif(auth()->user()->category_id == 3){
$course = $this->course;
  if($course->user){
    $name = $course->user->name;
  }
}
      $start = $this->start_time;
           return [
            'id' => $this->id,
            'title' => $this->name_ar,
            'date' => $this->date_lesson,
            'from' => $start ? Carbon::parse($start)->format('g:i A') : '',
             'lecturer_name' => $name ? $name : ''
        ];
    }
}
