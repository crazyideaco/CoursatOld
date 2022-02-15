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
class CityController extends Controller
{
    public function __construct()
    {
    //    $this->middleware(['permission:centers-create'])->only('addcenter');
        $this->middleware(['permission:cities-read'])->only('cities');
        $this->middleware(['permission:cites-update'])->only('editcity');
       // $this->middleware(['permission:teacher-delete'])->only('destroy');
    }
      public function cities(){
    return view('dashboard.cities')->with('states',State::orderBy('created_at','desc')->get())
    ->with('cities',City::orderBy('created_at','desc')->get());
}
public function deletecity(Request $request){
    $city = City::where('id',$request->id)->first();
    $city->delete();
    
     return response()->json(['status' => true,'data' => $city]);
}
public function addcity(Request $request){
   $validator = Validator::make($request->all(),[
      'state_id' => 'required',
	   'city' => 'required|unique:cities'
         ],
         [
        'state_id.required' => 'حقل المحافظه مطلوب  ' ,
        'city.unique' =>  'هذه المدينه موجوده',
		'city.required' => 'حقل المدينه مطلوب'
             ]
             );
             if($validator->passes()){
    $city =new City;
    $city->state_id = $request->state_id;
    $city->city = $request->city;
    $city->save();
    return response()->json(['status' => true,'data' => new CityResource1($city)]);}
else{
  $msg = $validator->messages()->first();
return response()->json(['status' => false, 'message' => $msg]);
}
    
}
  public function editcity($id){
    $city = City::where('id',$id)->first();
    return view('dashboard.editcity')->with('city',$city)->with('states',State::orderBy('created_at','desc')->get());
}
public function updatecity($id,Request $request){
    $city = City::where('id',$id)->first();
    $city->city = $request->city;
     $city->state_id = $request->state_id;
    $city->save();
      return redirect()->route('cities');
} public function getcity($id){
        $cities = City::where('state_id',$id)->get();
        $text = "";
          $text .= '<option value="0"   disabled>اختر مدينه</option>';
         foreach($cities as $city){
           $text.= '<option value="'.$city->id.'">'.$city->city.'</option>';
    }
        return response()->json($text);
    }
}