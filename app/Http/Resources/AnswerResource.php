<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
   public function toArray($request)
    {
  
  return [
     
    'id' => $this->id,
    'name' => $this->name,
    'correct' => $this->correct,
   
   ];
   }
}