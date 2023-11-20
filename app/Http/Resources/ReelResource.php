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
        "teacher_name" => $this->informations?->user?->name ?? "",
        "teacher_image" => $this->informations?->user->image ?? "",
        'teacher_image' => $this->informations?->user->image ? asset('uploads/' . $this->informations?->user->image) : null,
        "date" => $this->date_format ?? "",
        "video" => $this->video ?? "",

    ];
    }
}

