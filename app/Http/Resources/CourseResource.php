<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VideogeneralResource;
use App\Course_Rate;
class CourseResource extends JsonResource
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
        $rated = Course_Rate::where([['course_id','=',$this->id],['user_id','=',auth()->id()]])->first();
        if($rated){
            return $is_rated = true;
        }else{
            return $is_rated = false;
        }
        $rates = Course_Rate::where('course_id',$this->id)->get()->pluck('rate')->toArray();
         if(count($rates) > 0){
         $rate = array_sum($rates) / count($rates);}
         else{
             $rate = 0;
         }
       if(auth()->user()->stucourses()->pluck('course_id')->contains($this->id)){
           $is_book = 1;
           $allow = 1;
       }else{
          $is_book = 0;
           $allow = 0;
       }    if($this->center){
           $center_image = asset('uploads/'.$this->center['image']);
       }else{
           $center_image = asset('uploads/'.$this->user['image']);
       }if($this->center){
           $center_name = $this->center['name'];
       }else{
          $center_name = $this->user['name'];
       }
       $duration = array_sum($this->videos->pluck('seconds')->toArray());
        $videos_number = count($this->videos);
           return [
           'id'  => $this->id,
           'image' => asset('uploads/'.$this->image),
           'intro' => asset('uploads/'.$this->intro),
           'lecturer' => $this->user['name'],
           'lecturer_id' => $this->user_id,
           'posted_by' => $center_name,
           'posted_by_image' =>$center_image,
           'points' => $this->points,
           'description' => $this->description,
            'mintues' => 0,
           'name' => $this->name_ar,
           'subject' => $this->general['name_ar'],
           'videos_number' => $videos_number,
           'category_id' => 3,
               'mintues' => $duration > 0 ? intval($duration / 60) : 0,
           'is_book' => $is_book,
           'allow' => $allow,
           'rate'=> $rate,
           'is_rated'=> $is_rated ?? false,

          'videos ' => VideogeneralResource::collection($this->videos),
        ];
    }
}
