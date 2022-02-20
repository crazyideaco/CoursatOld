<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TypecollegeJoin;
use App\Student_Typecollege;
use Illuminate\Support\Facades\Auth;
use App\TypesCollege;
class MainPageController extends Controller{
public function main_page_basic(){
    if(auth()->user() && auth()->user()->isAdmin == 'admin'){
    $joins = TypecollegeJoin::get();
}elseif(Auth::user() &&Auth::user()->is_student == 3){

   $typescolleges =  TypesCollege::where('doctor_id',Auth::user()->id)
   ->orderBy('created_at','Desc')->get();
   $joins = TypecollegeJoin::where("typecollege_id",$typescolleges->pluck("id")->toArray())
   ->get();
 }elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
    $typescolleges =  TypesCollege::where('center_id',Auth::user()->id)
    ->orderBy('created_at','Desc')->get();
    $joins = TypecollegeJoin::where("typecollege_id",$typescolleges->pluck("id")->toArray())
    ->get();
 }
    return view('dashboard.mainpage.basic');
}

}
