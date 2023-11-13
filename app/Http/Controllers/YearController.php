<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\State;
use FFMpeg;
use App\Point;
use App\City;
use App\Year;
use App\Subject;
use App\Type;
use App\Subtype;
use App\Video;
use Illuminate\Support\Facades\File;
use App\User;
use App\Offer;
use App\User_Year;
use Illuminate\Validation\Rule;
use App\Category;
use App\Stage;
use App\College;
use App\Division;
use App\Section;
use App\SubjectsCollege;
use App\TypesCollege;
use App\Lesson;
use App\VideosCollege;
use App\General;
use App\Sub;
use App\Course;
use App\Sub_User;
use App\Stage_User;
use App\College_User;
use App\VideosGeneral;
use App\Bouquet;
use App\Notification;
use Session;
use Validator;
use App\Doctor_Subcollege;
use App\Doctor_Division;
use App\Doctor_Section;
use App\University;
use App\Specialbasic;
use App\Specialcollege;
use App\User_Subject;
use App\Center_Teacher;
use App\Center_Doctor;
use App\Center_Lecturer;
use App\Student_Typecollege;
use Illuminate\Support\Facades\Auth;
use Owenoj\LaravelGetId3\GetId3;
use App\Http\Resources\CityResource1;
use QrCode;
use App\Message;
use Carbon\Carbon;
use App\Student_Type;
use App\Paqa;
use App\Paqa_User;
use App\Student_Course;
use Illuminate\Support\Facades\Hash;
class YearController extends Controller
{
     public function __construct()
    {
     //  $this->middleware(['permission:years-create'])->only('addyear');
        $this->middleware(['permission:years-read'])->only('years');
        $this->middleware(['permission:years-update'])->only('edityears');
       $this->middleware(['permission:years-delete'])->only('deleteyear');
    }
  public function deleteyear($id){
    $year = Year::where('id',$id)->first();
    $year->delete();
    return response()->json(['status' => true]);
  }
     public function years(){
     return view('dashboard.years')->with("years",Year::orderBy('created_at', 'desc')->get())->
     with('stages',Stage::all());
 }  
 public function storeyears(Request $request){
	 //|unique:years,year_ar,stage_id
     $request->validate([
         'year_ar' => 'required',
         'year_en' => 'required',
         'stage_id' => 'required',
         ],
         [
             'required' => 'هذا الحقل مطلوب',
		 'unique' => 'هذه السنه موجوده فى هذه المرحله ']);
     $year = new Year;
     $year->year_ar = $request->year_ar;
     $year->year_en = $request->year_en;
     $year->stage_id = $request->stage_id;
     if($request->sandl){
    $year->sandl = $request->sandl;
     }else{
        $year->sandl =0; 
     }
     $year->save();
      return redirect()->route('years');
 }   
 public function edityears($id){
     $year = Year::where('id',$id)->first();
     return view('dashboard.edityears')->with("year",$year)->
     with('stages',Stage::all());
 }  
 public function updateyears($id,Request $request){
    $request->validate([
         'year_ar' => 'required',
        'year_en' => 'required',
         'stage_id' => 'required',
         ],
         [
             'required' => 'هذا الحقل مطلوب',
		 'unique' => 'هذه السنه موجوده فى هذه المرحله ']);
     $year = Year::where('id',$id)->first();
     $year->year_ar = $request->year_ar;
     $year->year_en = $request->year_en;
     $year->stage_id = $request->stage_id;
     if($request->sandl){
    $year->sandl = $request->sandl;
     }else{
        $year->sandl =0; 
     }
     $year->save();
      return redirect()->route('years');
 }
     public function getyear($id){
     if(Auth::user() &&Auth::user()->is_student == 2){
         $subjects = auth()->user()->subjects->where('years_id',$id); 
     }else{
   $subjects= Subject::where('years_id',$id)->get();}
   $text ="";
   $text .=' <option value="0"  selected="selected" disabled>اختر الماده</option>';
       foreach($subjects as $subject){
       $text .='<option value="'.$subject->id.'">'.$subject->name_ar.'</option>';
 }
 
     return response()->json($text);
 }

}