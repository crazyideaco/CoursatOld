<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\College;
use App\DataTables\Admin\StudentDataTable;
use App\Division;
use App\Http\Controllers\Controller;
use App\Section;
use App\Services\AuthDataService;
use App\Stage;
use App\Type;
use App\TypesCollege;
use App\University;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected $view = "dashboard.students.";
    public function allstudents(StudentDataTable $dataTable)
    {

        return $dataTable->render($this->view . 'index', [
            "stages" => Stage::all(),
            "universities" => University::all(),
        ]);
    }


    public function resetStudentPassword(Request $request, User $student)
    {
        try {

            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'required' => 'مطلوب ادخال الحقل',
                'password.min' => 'حقل كلمه السر لا يجب ان يقل عن 6 احرف',
                'password.confirmed' => 'كلمات السر غير متطابقة',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
            }

            $student->password = Hash::make($request->password);
            $student->save();

            DB::commit();
            return response()->json(['status' => true, 'message' => 'تم تغيير كلمة المرور بنجاح']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function studentprofile(User $student)
    {
        $student_courses = [];
        $courses = [];
        if ($student->category_id == config('project_types.system_category_type.category_id_college')) {
            $student_courses = $student->stutypescollege;
            $courses = Type::where('stage_id', $student->stage_id)->where('years_id', $student->year_id)->get();
        } elseif ($student->category_id == config('project_types.system_category_type.category_id_basic')) {
            $student_courses = $student->stutypes;
            $courses = TypesCollege::where('university_id', $student->university_id)->where('college_id', $student->college_id)->where('division_id', $student->division_id)->get();
        }


        return view('dashboard.students.show', [
            "courses" => $courses,
            'student' => $student,
            'student_courses' => $student_courses,
            'id' => $student->id,
        ]);
    }
}//End of controller
