<?php

namespace App\Http\Resources;

use App\Http\Resources\CourseResource;
use App\Http\Resources\LecturerResource;
use App\Http\Resources\TypecollegeResource;
use App\Http\Resources\TypeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Center_Teacher;
use App\Center_Doctor;
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

        if($this->id !== 0){
            if (auth()->user()->category_id == 1) {
                $centers = auth()->user()->stdcenters;
                $user_owners = Center_Teacher::get()->pluck("teacher_id")->toArray();

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
                if (count($centers) > 0) {
                $lectuers = \App\Subject::where('id', $this->id)->first()->teachers()->where("users.active", 1)->whereIn("users.id",$result)->get();
                }else{
                    $lectuers = \App\Subject::where('id', $this->id)->first()->teachers()->where("users.active", 1)->whereNotIn("users.id",$user_owners)->get();

                }
            } else if (auth()->user()->category_id == 2) {
                $centers = auth()->user()->stdcenters;
                $user_owners = Center_Doctor::get()->pluck("doctor_id")->toArray();

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
                    $lecturer_ids[] = $user->doctors->pluck("id")->toArray();
                }
                $result = call_user_func_array("array_merge", $lecturer_ids);
                if (count($centers) > 0) {

                $lectuers = \App\SubjectsCollege::where('id', $this->id)->first()->doctors()->where("users.active", 1)->whereIn("users.id",$result)->get();
                }else{
                    $lectuers = \App\SubjectsCollege::where('id', $this->id)->first()->doctors()->where("users.active", 1)->whereNotIn("users.id",$user_owners)->get();

                }
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
        return [
            'id' => 0,
            'title' => 'الكل',
            'courses' => [],
            'latest_courses' => [],
            'lecturers' => [],
        ];

    }
}
