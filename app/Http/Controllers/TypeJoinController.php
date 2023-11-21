<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeJoin;
use App\Student_Type;
use Illuminate\Support\Facades\Auth;
use App\Type;

class TypeJoinController extends Controller
{
    public function index()
    {
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $joins = TypeJoin::get();
        } elseif (Auth::user() && Auth::user()->is_student == 2) {

            $types =  Type::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'Desc')->get();
            $joins = TypeJoin::whereIn("type_id", $types->pluck("id")->toArray())
                ->get();
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
            $types =  Type::where('center_id', Auth::user()->id)
                ->orderBy('created_at', 'Desc')->get();
            $joins = TypeJoin::whereIn("type_id", $types->pluck("id")->toArray())
                ->get();
        }
        return view('dashboard.type_joins.index', compact('joins'));
    }
    public function accept_type_join($id)
    {
        $join = TypeJoin::where("id", $id)->first();
        $type = new Student_Type;
        $type->student_id = $join->student_id;
        $type->type_id  = $join->type_id;
        $type->type  = 2 ;

        $type->save();
        $join->user_id  = auth()->id();
        $join->status = 1;
        $join->save();
        $msg = "تم القبول بنجاح";
        return response()->json(['status' => true, "message" => $msg]);
    }
    public function refuse_type_join($id)
    {
        $join = TypeJoin::where("id", $id)->first();
        $join->user_id  = auth()->id();
        $join->status = 2;
        $join->save();
        $msg = "تم الرفض بنجاح";
        return response()->json(['status' => true, "message" => $msg]);
    }
}
