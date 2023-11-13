<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VideocollegeResource;
use App\Http\Resources\TagResource;

class LessonResource extends JsonResource
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
        if (auth()->user()->stutypescollege->pluck('id')->contains($this->typescollege_id)) {
            $allow = 1;
        } elseif (auth()->user()->stulessons()->pluck('lesson_id')->contains($this->id)) {
            $is_book = 1;
            $allow = 1;
        } else {
            $is_book = 0;
            $allow = 0;
        }


        $duration = array_sum($this->videos->pluck('seconds')->toArray());
        return [
            'id'  => $this->id,
            'image' => $this->image ? asset('uploads/' . $this->image) : null,
            'intro' => $this->intro ? asset('uploads/' . $this->intro) : null,
            'points' => $this->points,
            'description' => $this->description ? $this->description : '',
            'name' => $this->name_ar,
            'videos_number' => $videos_number,
            'allow' => $allow,
            'mintues' => $duration > 0 ? intval($duration / 60) : 0,
            'class_videos ' => VideocollegeResource::collection($this->videos()->orderBy('order_number', 'asc')->get()),
            'part_paper' => $this->part_paper ? asset("uploads/" . $this->part_paper) : '',
            'notes' =>  $this->notes ? asset('uploads/' . $this->notes) : '',
            'tags' => TagResource::collection($this->tags)



        ];
    }
}
