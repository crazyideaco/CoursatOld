<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideocollegeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      //dd($this->typescollege_id);
        if($this->paid == 0){
            $allow = 1;
         }  elseif(in_array($this->typescollege_id,auth()->user()->stutypescollege->pluck('id')->toArray())){
           
            $allow = 1;
          
        }else if(auth()->user()->stulessons->pluck('id')->contains($this->lesson_id)){
            $allow = 1;
         
        }else if($this->paid == 1){
            $allow = 0;
        }else{
            $allow = 0;
        
        }
         
   //  $getID3 = new \getID3;

//$video_file = $getID3->analyze(www.youtube.com/watch?v=6Mgqbai3fKo&list=RDMM&start_radio=1&rv=77nB_9uIcN4);

// Get the duration in string, e.g.: 4:37 (minutes:seconds)
/*$duration_string = $video_file['playtime_string'];

// Get the duration in seconds, e.g.: 277 (seconds)
$duration_seconds = $video_file['playtime_seconds'];*/
           return [
           'id'         => $this->id,
            'video_url' => $this->url_video_flutter,
           'image' => $this->image ? asset('uploads/'.$this->image) : null,
            'subject'=>$this->subjectscollege['name_ar'],
            'description'=>$this->description_ar,
            'pdf' =>  $this->pdf ? asset('uploads/'.$this->pdf) : null,
            'name' => $this->name_ar,
            'allow' => $allow,  
              'mintues' => $this->seconds > 0 ? intval($this->seconds / 60) : 0,
           'blackboard'=> $this->board ?  asset('uploads/' .$this->board) : '',
             
           
        ];
    }
}
