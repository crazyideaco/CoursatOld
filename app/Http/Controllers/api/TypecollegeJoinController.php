<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\TypecollegeJoin;
use App\TypesCollege;
use App\Http\Controllers\Controller;
use Validator;
use App\Type;
use App\TypeJoin;

class TypecollegeJoinController extends Controller
{

    public function index(Request $request)
    {
        if (auth()->user()->category_id == 1) {
            $validator = Validator::make($request->all(), [
                "typecollege_id" => "required"
            ], [
                "typecollege_id.required" => "حقل الكورس مطلوب"
            ]);
            if ($validator->passes()) {
                $type = Type::where("id", $request->typecollege_id)->first();
                if (!$type) {
                    $msg = "لا يوجد كورس بهذا الاسم";
                    return response()->json(['status' => false, "message" => $msg]);
                }
                $join = new TypeJoin;
                $join->student_id = auth()->id();
                $join->type_id = $request->typecollege_id;
                $join->save();
                $msg = "تم اضافه طلب الانضمام بنجاح";
                return response()->json(['status' => true, "message" => $msg]);
            } else {
                $msg = $validator->messages()->first();
                return response()->json(['status' => false, "message" => $msg]);
            }
        } else if (auth()->user()->category_id == 2) {
            $validator = Validator::make($request->all(), [
                "typecollege_id" => "required"
            ], [
                "typecollege_id.required" => "حقل الكورس مطلوب"
            ]);
            if ($validator->passes()) {
                $type = TypesCollege::where("id", $request->typecollege_id)->first();
                if (!$type) {
                    $msg = "لا يوجد كورس بهذا الاسم";
                    return response()->json(['status' => false, "message" => $msg]);
                }
                $join = new TypecollegeJoin;
                $join->student_id = auth()->id();
                $join->typecollege_id = $request->typecollege_id;
                $join->save();
                $msg = "تم اضافه طلب الانضمام بنجاح";
                return response()->json(['status' => true, "message" => $msg]);
            } else {
                $msg = $validator->messages()->first();
                return response()->json(['status' => false, "message" => $msg]);
            }
        }
    }
}
