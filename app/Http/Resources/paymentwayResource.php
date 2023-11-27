<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class paymentwayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            'title' => $this->title,
            'number' => $this->number,
            "image" => $this->image_link ?? "",
            // 'creator_name' => $this->creator->name,
        ];
    }
}
