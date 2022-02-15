<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\QuestionResource;
class ExamResource extends JsonResource
{
    public function toArray($request)
    {
      if(auth()->user()->category_id == 1){
        $subject = $this->subject->name_ar;
      } else if(auth()->user()->category_id == 2){
        $subject = $this->subjectscollege->name_ar;
      }
       
           return [
               
            'id' => $this->id,
            'title'=>$this->name,
             'from' => Carbon::parse($this->date_time)->format('g:i A'),
             'to' => Carbon::parse($this->date_time)->addMinutes($this->duration_time)->format('g:i A'),
             'duration' => intval($this->duration),
             'degree' =>  intval($this->score),
             'question_number' => intval($this->question_number),
           'subject' => $subject,
             'lecturer_name' => $this->user ? $this->user->name : '',
             'date_day' => $this->date_day,
             'questions' => QuestionResource::collection($this->questions)
             
        ];
    }
}
   