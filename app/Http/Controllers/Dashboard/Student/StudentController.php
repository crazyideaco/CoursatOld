<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\College;
use App\DataTables\Admin\StudentDataTable;
use App\Division;
use App\Http\Controllers\Controller;
use App\Section;
use App\Services\AuthDataService;
use App\Stage;
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
        if ($student->category_id == config('project_types.system_category_type.category_id_college')) {
            $courses = $student->stutypescollege;
        } elseif ($student->category_id == config('project_types.system_category_type.category_id_basic')) {
            $courses = $student->stutypes;
        }

        return view('dashboard.students.show', [
            // 'student' => $student,
            // 'courses' => $courses,
            'id' => $student->id,
        ]);
    }
}//End of controller
