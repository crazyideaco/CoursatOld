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
class DivisionController extends Controller
{
     public function __construct()
    {
        $this->middleware(['permission:divisions-create'])->only('adddivision');
        $this->middleware(['permission:divisions-read'])->only('divisions');
        $this->middleware(['permission:divisions-update'])->only('editdivision');
      $this->middleware(['permission:divisions-delete'])->only('deletedivision');
    }
     public function adddivision(){
     return view('dashboard.adddivision')->with('colleges',College::all())->with('universities',University::all());
 }
 public function storedivision(Request $request){
	 //|unique:division,name_ar,college_id
     $request->validate([
         'name_ar' => 'required',
         'college_id' => 'required',
         'name_en' =>'required',
         'university_id' => 'required'
         ],[
            'required' => 'هذا الحقل مطلوب',
			'unique' => 'هذا القسم موجود فى هذه الكليه'
             ]);
	 foreach($request->college_id as $value){
     $division = new Division;
       $division->college_id = $value;
       $division->university_id = $request->university_id;
        $division->name_ar = $request->name_ar;
           $division->name_en = $request->name_en;
        $division->save();}
     return redirect()->route('divisions');
} public function deletedivision($id){

     $division =  Division::where('id',$id)->first();
	 $division->delete();
   return response()->json(['status' => true]);
}
public function divisions(){
    return view('dashboard.divisions')->with('divisions',Division::orderBy('created_at','Desc')->get());
}
   public function editdivision($id){
     return view('dashboard.editdivision')->with('division',Division::where('id',$id)->first())
     ->with('colleges',College::all())->with('universities',University::all());
 }
 public function updatedivision($id,Request $request){
       $request->validate([
         'name_ar' => 'required',
         'college_id' => 'required',
         'name_en' => 'required',
         'university_id' => 'required'
         ],[
            'required' => 'هذا الحقل مطلوب'
             ]);
     $division = Division::where('id',$id)->first();
       $division->college_id = $request->college_id;
          $division->university_id = $request->university_id;
         $division->name_ar = $request->name_ar;
           $division->name_en = $request->name_en;
        $division->save();
     return redirect()->route('divisions');
}public function getdivision($id){
    $divisions = Division::where('college_id',$id)->get();
     $text = "";
        $text .='<option value="0" selected="selected"  disabled="disabled">ادخل القسم</option>';
                foreach($divisions as $division){
                       $text .= '<option value="'.$division->id.'">'.$division->name_ar.'</option>';
            }
            return response()->json($text);
}public function getdivision2($id){
    $divisions = Division::where('college_id',$id)->get();
     $text = "";
        $text .='<option value="0"   disabled="disabled">ادخل القسم</option>';
                foreach($divisions as $division){
                       $text .= '<option value="'.$division->id.'">'.$division->name_ar.'</option>';
            }
            return response()->json($text);
}

}