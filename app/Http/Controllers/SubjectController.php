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
class SubjectController extends Controller
{
     public function __construct()
    {
   $this->middleware(['permission:subjects-create'])->only('addsubject');
        $this->middleware(['permission:subjects-read'])->only('subjects');
        $this->middleware(['permission:subjects-update'])->only('editsubject');
       $this->middleware(['permission:subjects-delete'])->only('deletesubject');
    }
   public function subjects(){
     return view('dashboard.subjects')->with("subjects",Subject::orderBy('created_at', 'desc')->get());
 }public  function deletesubject($id){
       $subject = Subject::where('id',$id)->first();
       $subject->delete();
       return response()->json(['status' => true]);
     }
 public function addsubject(){
     return view('dashboard.addsubject')->with('years',Year::all())->with('stages',Stage::all());
 }
 public function storesubject(Request $request){

     $request->validate([
		 //|unique:subjects,name_ar
        'name_ar' => 'required',
        'name_en' => 'required',
        'years_id' => 'required|array',
		 'years_id.*' => 'required',
        'stage_id' => 'required',
        'sandl' => 'required',
        'image' => 'required|mimes:jpeg,jpg,png,gif'
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' => 'هذا الحقل يقبل صوره فقط',
		 'unique' => 'هذه الماده موجوده فى هذه السنه'
             ]);
	   if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
            
        }
	 foreach($request->years_id as $key =>$years_id){
         $subject[$key] = new Subject();
       $subject[$key]->image =time(). '.'.$image->getClientOriginalExtension();
         $subject[$key]->name_ar = $request->name_ar;
        $subject[$key]->name_en = $request->name_en;
         $subject[$key]->years_id = $years_id;
         $subject[$key]->stage_id = $request->stage_id;
         $subject[$key]->sandl = $request->sandl;
         $subject[$key]->save();}
         return redirect()->route('subjects');
 }
  public function editsubject($id){
	
     return view('dashboard.editsubject')->with('years',Year::all())->with('subject',Subject::where('id',$id)->first())
     ->with('stages',Stage::all());
 }
 public function updatesubject($id,Request $request){
    $request->validate([
        'name_ar' => 'required',
        'name_en' => 'required',
        'years_id' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif'
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' => 'هذا الحقل يقبل صوره فقط'
             ]);
         $subject = Subject::where('id',$id)->first();
          if($request->hasFile('image'))
        {
          //  $link = public_path() . '/uploads/' . $subject->image;
           // unlink($link);
            $image = $request->image;
            $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
            $subject->image = time(). '.'.$image->getClientOriginalExtension();
        }
         $subject->name_ar = $request->name_ar;
         $subject->name_en = $request->name_en;
         $subject->stage_id = $request->stage_id;
         $subject->sandl = $request->sandl;
         $subject->years_id = $request->years_id;
         $subject->save();
         return redirect()->route('subjects');
 } public function getmanysubs(Request $request){
     $subjects = Subject::whereIn('years_id',$request->year_id)->get();
     $text ="";
     foreach($subjects as $subject){
         $text .='<option value="'.$subject->id.'">'.$subject->name_ar.'</option>';
     }
     return response()->json(['data' => $text]);
 }public function activesubject(Request $request){
      if($request->status == 0){
     $studenttype = Subject::where([['id','=',$request->id]])->first();
    }elseif($request->status == 1){
      $studenttype = SubjectsCollege::where([['id','=',$request->id]])->first();
    }
    if($studenttype->active == 1){
         $studenttype->active = 0;
         $studenttype->save();
         return response(['status' => 'deactive']);
     }else if($studenttype->active == 0){
         $studenttype->active = 1;
         $studenttype->save();
         return response(['status' => 'active']);
     }
  }
}