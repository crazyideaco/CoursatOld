<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ReelResource extends JsonResource
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
        "id" => $this->id,
        "title" => $this->name ?? '',
        "teacher_name" => $this->information?->user?->name ?? "",
        // 'teacher_image' => $this->information?->user->image ? asset('uploads/' . $this->information?->user?->image) : null,
        'image' => $this->image ? asset('uploads/'.$this->image) : '' ,
        "date" => $this->date_format ?? "",
        "video" => $this->video ?? "",

    ];
    }
}

