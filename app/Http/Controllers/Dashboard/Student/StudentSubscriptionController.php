<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class StudentSubscriptionController extends Controller
{

    protected $view = "dashboard.students.profile-student-includes.";

    public function deleteuser_from_stutypes(Request $request)
    {
        $rules = [
            "type_id" => "required",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => $msg,
            ], 422);
        }
        $student = User::find($request->student_id);
        $student->stutypes()->detach($request->type_id);

        $msg = "تمت العملية بنجاح";
        return response()->json([
            'status' => true,
            'message' => $msg,
        ]);
    }


    public function deleteuser_from_stutypescollege(Request $request)
    {
        $rules = [
            "typecollege_id" => "required",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => $msg,
            ], 422);
        }
        $student = User::find($request->student_id);
        $student->stutypescollege()->detach($request->typecollege_id);

        $msg = "تمت العملية بنجاح";
        return response()->json([
            'status' => true,
            'message' => $msg,
        ]);
    }

    /** get the courses of specific student based on category */
    public function get_courses(Request $request)
    {
        dd('ddcouse student');
        $student = User::find($request->student_id);

        if ($student->category_id == config('project_types.system_category_type.category_id_college')) {
            $courses = $student->stutypescollege;
        } elseif ($student->category_id == config('project_types.system_category_type.category_id_basic')) {
            $courses = $student->stutypes;
        }

        return view($this->view . '__courses', [
            'courses' => $courses,
            'student' => $student
        ])->render();
    }
}//End of class
