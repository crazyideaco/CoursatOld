<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseResource;
class SubResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         $centers = auth()->user()->stdcenters;
       if(auth()->user()->category_id == 1){

            if(count($centers) > 0 ){
       $courses =  CourseResource::collection($this->courses()->whereIn('center_id',$centers->pluck('id'))->orWhereIn("user_id",$centers->pluck('id'))->where('active',1)->get());
            }else{
              $courses =  CourseResource::collection($this->courses()->where('center_id',null)->where('active',1)->get());
            }
       }else if(auth()->user()->category_id == 2){
         if(count($centers) > 0){
        $courses =   CourseResource::collection($this->courses()->whereIn('center_id',$centers->pluck('id'))->orWhereIn("doctor_id",$centers->pluck('id'))->where('active',1)->get());}else{
             $courses =   CourseResource::collection($this->courses()->where('center_id',null)->where('active',1)->get());
         }
       }
           return [
           'id'   => $this->id,
           'title'=>$this->name_ar,

           'courses' =>CourseResource::collection($this->courses)


        ];
    }
}
