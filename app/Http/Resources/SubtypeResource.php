<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VideoResource;
class SubtypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
       $videos_number = count($this->videos);
if(auth()->user()->stutypes->pluck('id')->contains($this->type_id)){
            $allow = 1;
	  }
      elseif(auth()->user()->stusubtypes()->pluck('subtype_id')->contains($this->id)){
           $is_book = 1;
           $allow = 1;
       }else{
          $is_book = 0;
           $allow = 0; 
       }  
      $duration = array_sum($this->videos->pluck('seconds')->toArray());
           return [
           'id'  => $this->id,
           'image' => $this->image ? asset('uploads/'.$this->image) : null,
           'intro' => $this->intro ? asset('uploads/'.$this->intro) : null,
           'points' => $this->points,
           'description' => $this->description,
           'name' => $this->name_ar,
           'videos_number' => $videos_number,
            'mintues' => $duration > 0 ? intval($duration / 60) : 0,
              'part_paper' => $this->part_paper ? asset("uploads/".$this->part_paper) : '',
           'class_videos ' => VideoResource::collection($this->videos()->orderBy('order_number','asc')->get()),
          'notes' =>  $this->notes ? asset('uploads/'.$this->notes) : '',
             'tags' => $this->tags->pluck('id')
         
            
        ];
    }
}
