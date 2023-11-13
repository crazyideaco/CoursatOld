<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CenterResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $centers = $this->stdcenters->where('is_student', 5);

        if ($this->category_id == 1) {
            $isp = 1;
        } else {
            $isp = 0;
        }

        return [
            'id'         => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'api_token' => $this->api_token,
            'info_compelete' => $this->info_compelete,
            'city' => ($this->city) ? $this->city['city'] : null,
            'phone_verify' => $this->phone_verify,
            'state' => ($this->state) ? $this->state['state'] : null,
            'api_token' => $this->api_token,
            'address' => $this->address,
            'is_primary' => $isp,
            'level' => ($this->stage) ? $this->stage['name_ar'] : null,
            'primary_year' => ($this->year) ? $this->year['year_ar'] : null,
            "description" => $this->description,
            'university' => ($this->university) ? $this->university['name_ar'] : null,
            'college' => ($this->college)  ? $this->college['name_ar'] : null,
            'department' => ($this->division) ? $this->division['name_ar'] : null,
            'college_year' => ($this->section) ? $this->section['name_ar'] : null,
            'centers' => CenterResource::collection($centers),
            'points' => $this->points ?? 0,
            "is_public_platform_or_private_platform" => $this->is_public_platform_or_private_platform,

        ];
    }
}
