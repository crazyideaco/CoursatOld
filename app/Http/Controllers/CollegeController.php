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
class CollegeController extends Controller
{
   public function __construct()
    {
        $this->middleware(['permission:colleges-create'])->only('addcollege');
        $this->middleware(['permission:colleges-read'])->only('colleges');
        $this->middleware(['permission:colleges-update'])->only('editcollege');
      $this->middleware(['permission:colleges-delete'])->only('deletecollege');
    }
   public function addcollege(){
    return view('dashboard.addcollege')->with('universities',University::all());
}
public function storecollege(Request $request){
 
  //|unique:college,name_ar,university_id
  $request->validate([
    'name_ar' => 'required',
     'name_en' => 'required',
      'image' => 'required|mimes:jpeg,jpg,png,gif',
       'university_id' => 'required'
              ],
[
 'required' => 'هذا الحقل مطلوب',
 'unique' => 'هذه الكليه موجوده فى هذه الجامعه',
  'mimes' => 'هذا الحقل يجب ان يكون صوره'
]);
 
   
           $image = $request->image;
           $image->move('uploads' , time().$image->getClientOriginalName());
          
       
  foreach($request->university_id as $key => $value){
    $college = new College;
    
       $college->category_id = $request->category_id;
       $college->name_ar = $request->name_ar;
       $college->name_en = $request->name_en;
       $college->university_id = $value;
    $college->image = time().$request->image->getClientOriginalName();
       $college->save();
  }
    return redirect()->route('colleges');
}
public function colleges(){
   return view('dashboard.college')->with('colleges',College::orderBy('created_at','Desc')->get());
}
  public function editcollege($id){
    return view('dashboard.editcollege')->with('college',College::where('id',$id)->first())->with('universities',University::all());
}
public function updatecollege($id,Request $request){
    $college = College::where('id',$id)->first();
   $request->validate([
    'name_ar' => 'required',
     'name_en' => 'required',
      'image' => 'mimes:jpeg,jpg,png,gif',
       'university_id' => 'required'
              ],
[
 'required' => 'هذا الحقل مطلوب',
 'unique' => 'هذه الكليه موجوده فى هذه الجامعه',
  'mimes' => 'هذا الحقل يجب ان يكون صوره'
]);
      if($request->hasFile('image'))
       {
      if(public_path() .'/uploads/' .$college->image){
      $link = public_path() .'/uploads/' .$college->image;
       unlink($link);
      }
           $image = $request->image;
           $image->move('uploads' , time().$image->getClientOriginalName());
           $college->image = time().$request->image->getClientOriginalName();
       }
       $college->category_id = $request->category_id;
       $college->name_ar = $request->name_ar;
       $college->name_en = $request->name_en;
        $college->university_id = $request->university_id;
       $college->save();
      return redirect()->route('colleges');
}public function deletecollege($id){
  $college = College::where('id',$id)->first();
$college->delete();
  return response()->json(['status' => true,'message' => 'تم المسح بنجاح']);
}public function getcolleges($id){
    $colleges = College::where('university_id',$id)->get();
    $text ="";
    $text .='<option selected ="selected" disabled ="disabled" value="0">اختر كليه</option>';
    foreach($colleges as $college){
        $text .= '<option value="'.$college->id.'">'.$college->name_ar.'</option>';
    }
    return response()->json(['data' => $text]);
}
}