<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class DateResource extends JsonResource
{
   public function toArray($request)
    {
      return [
       'id' => $this->id,
       'day' => $this->day->name_ar,
    'from_time' =>Carbon::parse($this->from_time)->format('g:i A'),
    'to_time' => Carbon::parse($this->to_time)->format('g:i A'),
         ];
   }
}