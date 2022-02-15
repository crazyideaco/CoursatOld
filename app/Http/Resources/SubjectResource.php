<?php

namespace App\Http\Resources;
use App\Http\Resources\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\LibrarySubtype;
use App\LibraryLesson;
class SubjectResource extends JsonResource
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
       $parts  = LibrarySubtype::where([['user_id','=',auth()->id()],['subjects_id','=',$this->id]])->get();
   } else if(auth()->user()->category_id == 2){
       $parts  = LibraryLesson::where([['user_id','=',auth()->id()],['subcollege_id','=',$this->id]])->get();
   }
       
           return [
       
            'id' => $this->id,
             'name' => $this->name_ar,
             "parts" =>count($parts),
             'countquestion' =>count($this->questions),
        ];
    }
}
