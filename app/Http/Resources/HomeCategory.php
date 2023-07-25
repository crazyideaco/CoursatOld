<?php

namespace App\Http\Resources;

use App\Http\Resources\CourseResource;
use App\Http\Resources\LecturerResource;
use App\Http\Resources\TypecollegeResource;
use App\Http\Resources\TypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeCategory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $users = auth()->user()->stdcenters;

        $result = [];
        //get lecturer_ids


        if (auth()->user()->category_id == 1) {
            $centers = auth()->user()->stdcenters;
            if (count($centers) > 0) {
                $courses = TypeResource::collection(\App\Type::where('active', 1)->where('subjects_id', $this->id)->whereIn('center_id', $centers->pluck('id'))->orWhereIn("user_id", $centers->pluck('id'))->get());
                $latest_courses = TypeResource::collection(\App\Type::where('active', 1)->where('subjects_id', $this->id)->whereIn('center_id', $centers->pluck('id'))->orWhereIn("user_id", $centers->pluck('id'))->orderBy('created_at', 'desc')->take(4)->get());
            } else {
                $courses = TypeResource::collection(\App\Type::where('active', 1)->where('subjects_id', $this->id)->where('center_id', null)->get());
                $latest_courses = TypeResource::collection(\App\Type::where('active', 1)->where('subjects_id', $this->id)->where('center_id', null)->orderBy('created_at', 'desc')->take(4)->get());
            }
            $lecturer_ids = [];
            foreach ($users as $user) {
                $lecturer_ids[] = $user->teachers->pluck("id")->toArray();
            }
            $result = call_user_func_array("array_merge", $lecturer_ids);
            $lectuers = \App\Subject::where('id', $this->id)->first()->teachers()->where("active", 1)->whereIn("id",$result)->get();
        } else if (auth()->user()->category_id == 2) {
            $centers = auth()->user()->stdcenters;
            if (count($centers) > 0) {
                $courses = TypecollegeResource::collection(\App\TypesCollege::where('active', 1)->where('subjectscollege_id', $this->id)->whereIn('center_id', $centers->pluck('id'))
                        ->orWhereIn("doctor_id", $centers->pluck('id'))->get());

                $latest_courses = TypecollegeResource::collection(\App\TypesCollege::where('active', 1)->where('subjectscollege_id', $this->id)->whereIn('center_id', $centers->pluck('id'))->orWhereIn("doctor_id", $centers->pluck('id'))->orderBy('created_at', 'desc')->take(4)->get());
            } else {
                $courses = TypecollegeResource::collection(\App\TypesCollege::where('active', 1)->where('subjectscollege_id', $this->id)->where('center_id', null)->get());

                $latest_courses = TypecollegeResource::collection(\App\TypesCollege::where('active', 1)->where('subjectscollege_id', $this->id)->where('center_id', null)->orderBy('created_at', 'desc')->take(4)->get());
            }
            $lecturer_ids = [];
            foreach ($users as $user) {
                $lecturer_ids[] = $user->dockers->pluck("id")->toArray();
            }
            $result = call_user_func_array("array_merge", $lecturer_ids);
            $lectuers = \App\SubjectsCollege::where('id', $this->id)->first()->doctors()->where("active", 1)->whereIn("id",$result)->get();
        } else if (auth()->user()->category_id == 3) {
            $courses = CourseResource::collection(\App\Course::where('active', 1)->get());
            $latest_courses = CourseResource::collection(\App\Course::where('active', 1)->orderBy('created_at', 'desc')->take(4)->get());
        }

        return [
            'id' => $this->id,
            'title' => $this->name_ar,
            'courses' => $courses,
            'latest_courses' => $latest_courses,
            'lectuers' => LecturerResource::collection($lectuers),
        ];
    }
}
