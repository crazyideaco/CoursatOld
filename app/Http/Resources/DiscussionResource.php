<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\ReplyResource;
class DiscussionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
      return[
        'id' => $this->id,
        'content' => $this->title,
        'user_name' => $this->user ? $this->user->name : '',
        'user_image' => $this->user ? $this->user->image ? asset('uploads/'.$this->image) : '' : '',
        'image' => $this->image ? asset('uploads/'.$this->image) : '',
        'tags' => TagResource::collection($this->tags),
         'time' => $this->created_at,
        'replies' => ReplyResource::collection($this->replies)
      ];
    }
}