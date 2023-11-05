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
class StateController extends Controller
{
   public function __construct()
    {
    //    $this->middleware(['permission:centers-create'])->only('addcenter');
        $this->middleware(['permission:states-read'])->only('states');
        $this->middleware(['permission:states-update'])->only('editstate');
       // $this->middleware(['permission:teacher-delete'])->only('destroy');
    }
   public function states(){
     return view('dashboard.states')->with("states",State::orderBy('created_at', 'desc')->get());
 } 
 public function addstate(Request $request){
     $validator = Validator::make($request->all(),[
      'state' => 'required|unique:states',
         ],
         [
        'state.required' => 'حقل المحافظه مطلوب  ' ,
        'state.unique' =>  'هذه المحافظه موجوده',
             ]
             );
             if($validator->passes()){
    $state =new State;
    $state->state = $request->state;
    $state->save();
    return response()->json(['status' => true,'data' => $state]);
			 }else{
			 $msg = $validator->messages()->first();
				 return response()->json(['status' => false,'message' => $msg ]);
				 }
    
}
public function deletestate(Request $request){
    $state = State::where('id',$request->id)->first();
    $state->delete();
    if(  $cities =  City::where('state_id',$request->id)){
        $cities->delete();
    }
    
     return response()->json(['status' => true,'data' => $state]);
}    public function editstate($id){
        return view('dashboard.editstate')->with('state',State::where('id',$id)->first());
    }
    public function updatestate($id ,Request $request){
        $state = State::where('id',$request->id)->first();
    $state->state = $request->state;
    $state->save();
      return redirect()->route('states');
    }  public function storestates(Request $request){
       // dd($request->all());
       $st = State::where('state',$request->state)->first();
        if($st !== null){
       $city = new City;
        $city->city = $request->city;
        $city->state_id = $st->id;
        $city->save();
       }
       else{
        $state = new State;
        $state->state = $request->state;
        $state->save();
        $city = new City;
        $city->city = $request->city;
        $city->state_id = $state->id;
        $city->save();
       }
        return redirect()->route('states');
    }
}