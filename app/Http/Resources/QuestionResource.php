<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AnswerResource;
class QuestionResource extends JsonResource
{
   public function toArray($request)
    {
  
  return [
     
    'id' => $this->id,
    'name' => $this->name,
    'degree' => $this->score,
    'question_image' => $this->question_image ? asset('uploads/'.$this->question_image) : '',
    'answers' => AnswerResource::collection($this->answers),
    'explaination' => [
      'notes' => $this->notes ? $this->notes : '',
      'image' => $this->image ? asset('uploads/'.$this->image) : '',
      'video' => $this->video ? asset('uploads/'.$this->video) : '',
    ],
   ];
   }
}