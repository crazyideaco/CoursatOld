<?php

namespace App\Http\Resources;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Http\Resources\Json\JsonResource;
use FFMpeg;
class VideoResource extends JsonResource
{
    public function toArray($request)
    {
           if($this->paid == 0){
            $allow = 1;
         } else if(auth()->user()->stutypes->pluck('id')->contains($this->type_id)){
            $allow = 1;
        }else if(auth()->user()->stusubtypes->pluck('id')->contains($this->subtype_id)){
            $allow = 1;
        } else if($this->paid == 1){
            $allow = 0;
        }else{
            $allow = 0;
		}


		
		
           return [
           'id'   => $this->id,
            'video_url' => $this->url_link ?? null,//$this->url ? asset('uploads/'.$this->url) : null,
           'image' => $this->image ? asset('uploads/'.$this->image) : null,
            //'image'=> asset('uploads/'.$this->image),
            'subject'=>$this->subject->name_ar,
            'description'=>$this->description,
               'pdf' =>  $this->pdf ? asset('uploads/'.$this->pdf) : null,
            'name' => $this->name_ar,
            'allow' => $allow,
               'mintues' => $this->seconds > 0 ? intval($this->seconds / 60) : 0,
             'blackboard'=> $this->board ?  asset('uploads/' .$this->board) : ''
			
   
           
        ];
    }
}
