<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CenterResource;
use App\Http\Resources\TypeResource;
use App\Http\Resources\TypecollegeResource;
class LecturerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      if($this->is_student == 2){
          $types = \App\Type::where('user_id',$this->id)->where('center_id',null)->get();
          $types = TypeResource::collection($types);
          $subjects = $this->subjects()->pluck('name_ar');
          $years = $this->years->pluck('name_ar');
          if($this->belongcenter1()){
                $center_name = $this->belongcenter1()->pluck('name');
                $images = [];
                foreach($this->belongcenter1()->pluck('image') as $image){
                    $images [] = asset('uploads/'. $image);
                }
          }

      }else if($this->is_student == 3){
          $types = \App\TypesCollege::where('doctor_id',$this->id)->where('center_id',null)->get();
          $types = TypecollegeResource::collection($types);
          $subjects = $this->subcolleges()->pluck('name_ar');
          $years = $this->sections()->pluck('name_ar');
          if($this->belongcenter2()){
                $center_name = $this->belongcenter2()->pluck('name');
                $images = [];
                foreach($this->belongcenter2()->pluck('image') as $image){
                    $images [] = asset('uploads/'. $image);
                }
          }
      }

           return [
           'id'         => $this->id,
           'name'=>$this->name,
            'image' => asset('uploads/'. $this->image),
            //'courses' => $types
            'subjects' => $subjects->implode(","),
            'years' => $years->implode(","),
            'follow_to' => $center_name,
            'follow_to_img' => $images,
            'visitors' => count($this->centerstudents),
            'decription' => $this->description
        ];
    }
}
