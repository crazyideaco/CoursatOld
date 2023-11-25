<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class StudentSubscriptionController extends Controller
{


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
}//End of class
