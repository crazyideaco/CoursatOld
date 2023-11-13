<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\State;
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
class SubjectsCollegeController extends Controller
{
  public function __construct()
    {
        $this->middleware(['permission:subcolleges-create'])->only('addsubcollege');
        $this->middleware(['permission:subcolleges-read'])->only('subcolleges');
        $this->middleware(['permission:subcolleges-update'])->only('editsubcollege');
      $this->middleware(['permission:subcolleges-delete'])->only('deletesubcollege');
    }
    public function addsubcollege(){
    return view('dashboard.addsubcollege')->with('colleges',College::all())->with('divisions',Division::all())->
    with('sections',Section::all())->with('universities',University::all());
}
public function storesubcollege(Request $request){
  //|unique:subjectscollege,name_ar,section_id
     $request->validate([
        'name_ar' => 'required',
        'college_id' => 'required',
        'name_en' => 'required',
        'university_id' => 'required',
        'division_id' => 'required',
        'section_id' => 'required'
        ],[
           'required' => 'هذا الحقل مطلوب',
           'unique' => 'هذه الماده موجوده فى الفرقه'
            ]);
  
  foreach($request->section_id as $key => $section_id){
        $subcollege = new SubjectsCollege;
        $subcollege->college_id = $request->college_id;
        $subcollege->division_id = $request->division_id; 
        $subcollege->section_id = $section_id; 
       $subcollege->name_ar = $request->name_ar;
       $subcollege->university_id = $request->university_id;
       $subcollege->name_en = $request->name_en;
       $subcollege->save();}
    return redirect()->route('subcolleges');
} public function deletesubcollege($id){


        $subcollege =  SubjectsCollege::where('id',$id)->first();
    $subcollege->delete();
     return response()->json(['status' => true]);
}public function subcolleges(){
  return view('dashboard.subcolleges')->with('subcolleges',SubjectsCollege::orderBy('created_at','Desc')->get());
}
 public function editsubcollege($id){
   return view('dashboard.editsubcollege')->with('colleges',College::all())->with('divisions',Division::all())
   ->with('sections',Section::all())->
   with('subcollege',SubjectsCollege::where('id',$id)->first())->with('universities',University::all());
}
public function updatesubcollege($id,Request $request){
    $request->validate([
       'name_ar' => 'required',
       'college_id' => 'required',
       'name_en' => 'required',
       'university_id' => 'required',
       'division_id' => 'required',
       'section_id' => 'required'
       ],[
          'required' => 'هذا الحقل مطلوب'
           ]);
   $subcollege = SubjectsCollege::where('id',$id)->first();
       $subcollege->college_id = $request->college_id;
   $subcollege->division_id = $request->division_id; 
   $subcollege->section_id = $request->section_id; 
     $subcollege->name_ar = $request->name_ar;
     $subcollege->university_id = $request->university_id;
      $subcollege->name_en = $request->name_en;
      $subcollege->save();
   return redirect()->route('subcolleges');
}function getsubcollege2(Request $request){
    
    $subcolleges = SubjectsCollege::whereIn('section_id',$request->subcollege)->get();
     $text = "";
        $text .='<option value="0"   disabled="disabled" selected="selected">ادخل الماده</option>';
                foreach($subcolleges as $subcollege){
                       $text .= '<option value="'.$subcollege->id.'">'.$subcollege->name_ar.'</option>';
            }
            return response()->json($text);
}public function getsubcollege($id){
    $subcolleges = SubjectsCollege::where('section_id',$id)->get();
     $text = "";
        $text .='<option value="0"  selected="selected"    disabled="disabled">ادخل الماده</option>';
                foreach($subcolleges as $subcollege){
                       $text .= '<option value="'.$subcollege->id.'">'.$subcollege->name_ar.'</option>';
            }
            return response()->json($text);
}public function getdocsubcollege($id){
    $subids = Doctor_Subcollege::where('doctor_id',auth()->user()->id)->pluck('subcollege_id')->toArray();
    $subcolleges = SubjectsCollege::whereIn('id',$subids)->where('section_id',$id)->get();
     $text = "";
        $text .='<option value="0"   disabled="disabled" selected="selected">ادخل الماده</option>';
                foreach($subcolleges as $subcollege){
                       $text .= '<option value="'.$subcollege->id.'">'.$subcollege->name_ar.'</option>';
            }
            return response()->json($text);
}
}