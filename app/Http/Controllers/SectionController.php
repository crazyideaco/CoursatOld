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
class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:sections-create'])->only('addsection');
        $this->middleware(['permission:sections-read'])->only('sections');
        $this->middleware(['permission:sections-update'])->only('editsection');
      $this->middleware(['permission:sections-delete'])->only('deletesection');
    }
  public function addsection(){
     return view('dashboard.addsection')->with('colleges',College::all())->
     with('divisions',Division::all())->with('universities',University::all());
 }
 public function storesection(Request $request){
	 //|unique:section,name_ar,division_id
      $request->validate([
         'name_ar' => 'required',
         'college_id' => 'required',
         'name_en' => 'required',
         'university_id' => 'required',
         'division_id' => 'required'
         ],[
            'required' => 'هذا الحقل مطلوب',
             'unique' => 'هذه السنه موجوده فى هذا القسم '
	  ]);
	  foreach($request->division_id as $value){
     $section = new Section;
     $section->college_id = $request->college_id;
     $section->division_id = $value; 
        $section->name_ar = $request->name_ar;
        $section->name_en = $request->name_en;
         $section->university_id = $request->university_id;
        $section->save();}
     return redirect()->route('sections');
}public function deletesection($id){

     $section =  Section::where('id',$id)->first();
	 $section->delete();
   return response()->json(['status' => true]);
}
public function sections(){
    return view('dashboard.sections')->with('sections',Section::orderBy('created_at','Desc')->get());
}
   public function editsection($id){
     return view('dashboard.editsection')->with('colleges',College::all())->with('divisions',Division::all())
     ->with('section',Section::where('id',$id)->first())->with('universities',University::all());
 }
 public function updatesection($id,Request $request){
      $request->validate([
         'name_ar' => 'required',
         'college_id' => 'required',
         'name_en' => 'required',
         'university_id' => 'required',
         'division_id' => 'required'
         ],[
            'required' => 'هذا الحقل مطلوب'
        ]);
     $section = Section::where('id',$id)->first();
        $section->college_id = $request->college_id;
     $section->division_id = $request->division_id; 
         $section->name_ar = $request->name_ar;
        $section->name_en = $request->name_en;
         $section->university_id = $request->university_id;
        $section->save();
     return redirect()->route('sections');
}
public function getsection($id){
        $sections = Section::where('division_id',$id)->get();

     $text = "";
        $text .='<option value="0" selected="selected"   disabled="disabled">ادخل الفرقه</option>';
                foreach($sections as $section){
                       $text .= '<option value="'.$section->id.'">'.$section->name_ar.'</option>';
            }
            return response()->json($text);
}public function getsection2(Request $request ){
 
    $sections = Section::whereIn('division_id',$request->division)->get();
     
     $text = "";
        $text .='<option value="0"   disabled="disabled" selected="selected">ادخل الفرقه</option>';
                foreach($sections as $section){
                       $text .= '<option value="'.$section->id.'">'.$section->name_ar.'</option>';
            }
            return response()->json($text);
}public function getdocsection($id){
    $secids = Doctor_Section::where('doctor_id',auth()->user()->id)->pluck('section_id')->toArray();
        $sections = Section::whereIn('id',$secids)->where('division_id',$id)->get();
     $text = "";
        $text .='<option value="0"   disabled="disabled" selected="selected">ادخل الفرقه</option>';
                foreach($sections as $section){
                       $text .= '<option value="'.$section->id.'">'.$section->name_ar.'</option>';
            }
            return response()->json($text);
}
}