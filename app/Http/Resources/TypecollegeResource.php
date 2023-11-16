<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LessonResource;
use App\Typecollege_Rate;
use App\TypecollegeJoin;
class TypecollegeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_rated = false;
        $rated = Typecollege_Rate::where([['typecollege_id','=',$this->id],['user_id','=',auth()->id()]])->first();
        if($rated){
            $is_rated = true;
        }else{
            $is_rated = false;
        }

         $rates = Typecollege_Rate::where('typecollege_id',$this->id)->get()->pluck('rate')->toArray();
         if(count($rates) > 0){
         $rate = array_sum($rates) / count($rates);}
         else{
             $rate = 0;
         }
       if(auth()->user()->stutypescollege()->pluck('typecollege_id')->contains($this->id)){
           $is_book = 1;
           $allow = 1;
       }else{
          $is_book = 0;
           $allow = 0;
       }
        if($this->center){
           $center_image = asset('uploads/'.$this->center['image']);
       }else{
           $center_image = asset('uploads/'.$this->doctor['image']);
       }if($this->center){
           $center_name = $this->center['name'];
       }else{
          $center_name = $this->doctor['name'];
       }
       $status = 0;
       $join = TypecollegeJoin::where([["typecollege_id","=",$this->id],
       ["student_id","=",auth()->id()]])->first();

       if(!$join){
           $status = 0;
       }elseif($join->status == 0){
        $status = 1;
       }elseif($join->status == 1){
        $status = 2;
       }
       $duration = array_sum($this->videos->pluck('seconds')->toArray());
           return [
           'id'  => $this->id,
           'image' => $this->image ? asset('uploads/'.$this->image) : null,
           'intro' => $this->intro ? asset('uploads/'.$this->intro) : null,
           'lecturer' => $this->doctor['name'],
           'lecturer_id' => $this->doctor_id,
            'lecturer_image' => $this->doctor ? asset('uploads/'.$this->doctor['image']) : null,
           'posted_by' => $center_name,
           'posted_by_image' =>$center_image,
           'points' => $this->points,
           'description' => $this->description ? $this->description : '',
           'name' => $this->name_ar,
           'subject' => $this->subjectscollege['name_ar'],
            'mintues' => $duration > 0 ? intval($duration / 60) : 0,
           //'classes' => LessonResource::collection($this->lessons),
           'is_book' => $is_book,
           'allow' => $allow,
           'rate'=> $rate,
           'is_rated'=> $is_rated ?? false,

           'category_id' => 2,
           "status" => $status


        ];
    }
}
