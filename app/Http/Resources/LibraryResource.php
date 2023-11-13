<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\ReplyResource;
use App\Lesson;
class LibraryResource extends JsonResource
{

    public function toArray($request)
    {
      $name = "";
      if(auth()->user()->category_id == 1){
        $lesson_id = $this->subtype_id;
        if($this->subtype){
          
            $part = $this->subtype->part_paper ? asset("uploads/".$this->subtype->part_paper) : "";
        
          $name = $this->subtype->name_ar ?? "";
        }
      }else if(auth()->user()->category_id == 2){
        $lesson_id = $this->lesson_id;
         if($this->lesson){
      
            $part = $this->lesson->part_paper ? asset("uploads/".$this->lesson->part_paper) : "";

          $name = $this->lesson->name_ar ?? "";
        }
      }
      
      return[
        'id' => $this->id,
        'lesson_id' => $lesson_id,
        'link' => $part,
        'allow' => $this->status,
        'paper' => $name,
        'points' => intval($this->part_points),
      ];
    }
}