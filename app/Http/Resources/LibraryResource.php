<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\ReplyResource;
class LibraryResource extends JsonResource
{

    public function toArray($request)
    {
      if(auth()->user()->category_id == 1){
        $lesson_id = $this->subtype_id;
        if($this->subtype){
          if($this->subtype->part_paper){
            $part = asset("uploads/".$this->part_paper);
          }else{
            $part ="";
          }
        }
      }else if(auth()->user()->category_id == 2){
        $lesson_id = $this->lesson_id;
         if($this->lesson){
          if($this->lesson->part_paper){
            $part = asset("uploads/".$this->part_paper);
          }else{
            $part ="";
          }
        }
      }
      
      return[
        'id' => $this->id,
        'lesson_id' => $lesson_id,
        'link' => $part,
        'allow' => $this->status,
        'paper' => $part,
        'points' => intval($this->part_points),
      ];
    }
}