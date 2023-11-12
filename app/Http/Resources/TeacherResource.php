<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $videos = VideoResource::collection(\App\Video::where('user_id', $this->id)->get());
        if ($videos == null) {
            $videos = [];
        } else {
            $videos = $videos;
        }
        $subject = \App\Subject::where('id', $this->subject_id)->first();
        if ($subject == null) {
            $subject = null;
        } else {
            $subject = $subject->name;
        }
        $years = json_decode($this->year_id);
        // dd($years);
        foreach ($years as $year) {

            $year = \App\Year::where('id', $year)->first();
            $yearr[] = $year->year;
        }

        if ($year == null) {
            $year = "";
        } else {
            $year = implode(" ", $yearr);
        }

        return [
            'id'         => $this->id,
            'video' => $videos,
            'subject' => $subject,
            'years' => $year,
            'address' => $this->address,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            'name' => $this->name,
            "description" => $this->description,


        ];
    }
}
