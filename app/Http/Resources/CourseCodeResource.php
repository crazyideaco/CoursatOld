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
            'secure'  => intval($this->simulator) ?? '',
            "show_video_code" => intval($this->show_video_code) ?? "",
            "video_code_type" => intval($this->video_code_type) ?? "",
            "code_duration" => intval($this->code_duration) ?? "",
        ];
    }
}
