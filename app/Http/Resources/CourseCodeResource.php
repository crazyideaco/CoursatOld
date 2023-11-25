<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'secure'  => intval($this->simulator) ?? 1,
            "show_video_code" => intval($this->show_video_code) ?? 0,
            "video_code_type" => intval($this->video_code_type) ?? 0,
            "code_duration" => intval($this->code_duration) ?? 0,
        ];
    }
}
