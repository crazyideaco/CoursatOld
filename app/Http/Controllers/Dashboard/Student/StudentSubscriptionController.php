<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function addUserToCourse(Request $request)
    {
        DB::beginTransaction();
        $rules = [
            "course_id" => "required",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => $msg,
            ], 422);
        }
        // dd($request->course_id);
        $student = User::find($request->student_id);
        // dd($student);
        if ($student->category_id == config('project_types.system_category_type.category_id_college')) {
            $courseExists = !$student->stutypescollege()->where('typescollege.id', $request->course_id)->exists();
dd($courseExists);
            if ($courseExists) {
                $student->stutypescollege()->attach($request->course_id);
                // $student->stutypescollege()->updateExistingPivot($request->course_id, ['type' => config('project_types.pivot_type_in_student_type.dashboard')]);
                DB::commit();
            } else {
                DB::rollBack();
                $msg = "الطالب مسجل في الكورس بالفعل";
                return response()->json([
                    'status' => false,
                    'message' => $msg,
                ]);
            }
        } elseif ($student->category_id == config('project_types.system_category_type.category_id_basic')) {
            $course_exists = !$student->stutypes()->where('types.id', $request->course_id)->exists();
            if ($course_exists) {
                $student->stutypes()->attach($request->course_id);
                $student->stutypes()->updateExistingPivot($request->course_id, ['type' => config('project_types.pivot_type_in_student_type.dashboard')]);
                DB::commit();
            } else {
                DB::rollBack();
                $msg = "الطالب مسجل في الكورس بالفعل";
                return response()->json([
                    'status' => false,
                    'message' => $msg,
                ], 422);
            }
        }
    }
    /** get the courses of specific student based on category */
    public function get_courses(Request $request)
    {
        $student = User::find($request->student_id);

        if ($student->category_id == config('project_types.system_category_type.category_id_college')) {
            $courses = $student->stutypescollege;
        } elseif ($student->category_id == config('project_types.system_category_type.category_id_basic')) {
            $courses = $student->stutypes;
        }

        $text = "";
        $courses()->when($request->course_date, function ($q) use ($request) {
            return $q->wherePivot('created_at', '>=', $request->course_date);
        })->get();
        foreach ($courses as $item) {
            $text .= '<tr>
            <th scope="row" id="course_row' . $item->id . '">' . $item->id . '</th>
                <td>' .  $item->name_ar . '</td>
                <td>' .  $item->pivot->created_at . '</td>
                <td>' .  $item->pivot->getTypeFormatAttribute() . '</td>
                <td>' .  $item->center_id ? $item->center->name : "--" . '</td>';
            if ($student->category_id == config('project_types.system_category_type.category_id_college')) {
                $text .= '<td onclick="deleteuser_from_stutypescollege(' .  $student->id . ',' .  $item->id . ')" title="حذف الطالب من هذا الكورس"><i class="fas fa-trash-alt delet"></i></td>';
            } elseif ($student->category_id == config('project_types.system_category_type.category_id_basic')) {
                $text .= '<td onclick="deleteuser_from_stutypes(' .  $student->id . ',' .  $item->id . ')" title="حذف الطالب من هذا الكورس"><i class="fas fa-trash-alt delet"></i></td>';
            }
            $text .=
                '</tr>';
        }

        return response()->json(['status' => true, 'data' => $text]);
        // return view('dashboard.students.profile-student-includes.__courses', [
        //     'courses' => $courses,
        //     'student' => $student
        // ])->render();
    }
}//End of class
