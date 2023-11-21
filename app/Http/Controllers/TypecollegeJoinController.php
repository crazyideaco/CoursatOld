<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TypecollegeJoin;
use App\Student_Typecollege;
use Illuminate\Support\Facades\Auth;
use App\TypesCollege;
class TypecollegeJoinController extends Controller{
public function index(){
    if(auth()->user() && auth()->user()->isAdmin == 'admin'){
    $joins = TypecollegeJoin::get();
}elseif(Auth::user() &&Auth::user()->is_student == 3){

   $typescolleges =  TypesCollege::where('doctor_id',Auth::user()->id)
   ->orderBy('created_at','Desc')->get();
   $joins = TypecollegeJoin::whereIn("typecollege_id",$typescolleges->pluck("id")->toArray())
   ->get();
 }elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
    $typescolleges =  TypesCollege::where('center_id',Auth::user()->id)
    ->orderBy('created_at','Desc')->get();
    $joins = TypecollegeJoin::whereIn("typecollege_id",$typescolleges->pluck("id")->toArray())
    ->get();
 }
    return view('dashboard.typecollege_joins.index',compact('joins'));
}public function accept_typecollege_join($id){
    $join = TypecollegeJoin::where("id",$id)->first();
    $type = new Student_Typecollege;
    $type->student_id = $join->student_id;
    $type->typecollege_id  = $join->typecollege_id ;
    $type->type  = 2 ;
    $type->save();
    $join->user_id  = auth()->id();
    $join->status =1;
    $join->save();
    $msg = "تم القبول بنجاح";
    return response()->json(['status' => true,"message" => $msg]);
}public function refuse_typecollege_join($id){
    $join = TypecollegeJoin::where("id",$id)->first();
    $join->user_id  = auth()->id();
    $join->status =2;
    $join->save();
    $msg = "تم الرفض بنجاح";
    return response()->json(['status' => true,"message" => $msg]);
}
}
