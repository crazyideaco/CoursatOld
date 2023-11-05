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
class SubController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:sub-create'])->only('addsub');
        $this->middleware(['permission:sub-read'])->only('sub');
        $this->middleware(['permission:sub-update'])->only('editsub');
      $this->middleware(['permission:sub-delete'])->only('deletesub');
    }
    public function addsub(){
    return view('dashboard.addsub')->with('generals',General::orderBy('created_at','Desc')->get());
}
public function storesub(Request $request){
//	 |unique:sub,name_ar,general_id
      $request->validate([
        'name_ar' => 'required',
        'name_en' => 'required',
        'general_id' => 'required'],
        [
       'required' => 'هذا الحقل مطلوب'   ,
      'unique' => 'هذا القسم الفرعى موجود فى القسم العام من قبل'
            ]);
      $sub = new Sub;
       $sub->general_id = $request->general_id;
       $sub->name_ar = $request->name_ar;
        $sub->name_en = $request->name_en;
       $sub->save();
    return redirect()->route('sub');
}
public function sub(){
   return view('dashboard.sub')->with('subs',Sub::orderBy('created_at','Desc')->get());
}
  public function editsub($id){
    return view('dashboard.editsub')->with('sub',Sub::where('id',$id)->first())->
    with('generals',General::orderBy('created_at','Desc')->get());
}  public function deletesub($id){
    $sub = Sub::where('id',$id)->first();
    $sub->delete();
    return response()->json(['status' => true]);
}
public function updatesub($id,Request $request){
  //|unique:sub,name_ar,$id,general_id"
     $request->validate([
           'name_ar' => "required",
        'name_en' => "required",
        'general_id' => 'required'],
        [
       'required' => 'هذا الحقل مطلوب',
     'unique' => 'هذا القسم الفرعى موجود فى القسم العام من قبل'
            ]);
    $sub = Sub::where('id',$id)->first();
     $sub->general_id = $request->general_id;
    $sub->name_ar = $request->name_ar;
        $sub->name_en = $request->name_en;
       $sub->save();
    return redirect()->route('sub');
} public function getsub($id){
     $subs = Sub::where('general_id',$id)->get();
     $text ="";
      $text .=' <option value="0" selected="selected" disabled>اختر القسم الفرعى</option>';
       foreach($subs as $sub){
       $text .='<option value="'.$sub->id.'">'.$sub->name_ar.'</option>';
 }
    return response()->json($text);
 }
}