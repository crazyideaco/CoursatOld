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
use App\Models\Permission;
class DoctorController extends Controller
{
       public function __construct()
    {
        $this->middleware(['permission:doctors-create'])->only('adddoctor');
        $this->middleware(['permission:doctors-read'])->only('doctors');
        $this->middleware(['permission:doctors-update'])->only('editdoctor');
       // $this->middleware(['permission:teacher-delete'])->only('destroy');
    }
  public function adddoctor(){
     return view('dashboard.adddoctor')->
     with('subjectscollegs',SubjectsCollege::all())->with('colleges',College::all())->with('divisions',Division::all())->
     with('sections',Section::all())
     ->with('states',State::all())->with('subcolleges',SubjectsCollege::all())->with('universities',University::all());
 }
 public function storedoctor(Request $request){
   
    $validator = Validator::make($request->all(),[
        'password' => 'required',
        'name' => 'required|unique:users',
        'phone' => 'required|unique:users|numeric|regex:/(01)[0-9]{9}/',
      'image' => 'required',
      //|mimes:jpeg,jpg,png,gif',
  //  'printsplash' => 'required|mimes:jpeg,jpg,png,gif',

      'state_id' => 'required',
      'address' => 'required',
      'city_id' => 'required',
      'email' => 'required|unique:users',
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' =>  ' هذا الحقل يقبل صوره فقط',
        'phone.numeric' => ' رقم الهاتف يقبل رقما فقط',
        'phone.unique' => 'هذا الرقم  مستخدم من قبل',
        'email.unique' => ' هذا الايميل موجود من قبل',
        'name.unique' => 'اسم المستخدم موجود من  قبل ',
        'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
		'image.required' => 'حقل الصوره مطلوب'
             ]);
   
             if($validator->passes())
			{
     	$user = new User;
			$user->password = Hash::make($request->password);
			$user->name=$request->name;
			$user->phone=$request->phone;
			$user->state_id = $request->state_id;
			$user->city_id = $request->city_id;
			$user->address = $request->address;
		   $user->is_student=3;
			$user->description=$request->description;
			$user->email=$request->email;
		  $user->code = rand(10,10000).rand(4,9999);
			$user->college_id = $request->college_id;
			$user->university_id = $request->university_id;
		 	if($request->hasFile('cover_image'))
        {
            $cover_image = $request->cover_image;
            $cover_image->move('uploads' ,time(). $cover_image->getClientOriginalName());
            $user->cover_image =time(). $request->cover_image->getClientOriginalName();
        }
			if($request->hasFile('printsplash'))
        {
            $printsplash = $request->printsplash;
            $printsplash->move('uploads' ,time(). $printsplash->getClientOriginalName());
            $user->printsplash =time(). $request->printsplash->getClientOriginalName();
        }	if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time().$image->getClientOriginalName());
            $user->image = time().$request->image->getClientOriginalName();
        }	if($request->hasFile('intro'))
        {
            $intro = $request->intro;
            $intro->move('uploads' , time(). '.'.$intro->getClientOriginalExtension());
            $user->intro = time(). '.'.$intro->getClientOriginalExtension();
        }
         $user->save();
          if(Auth::user() && Auth::user()->is_student == 5 && Auth()->user()->category_id == 2){
          $cu = new Center_Doctor;
          $cu->center_id = auth()->user()->id;
          $cu->doctor_id = $user->id;
          $cu->save();
       }
        foreach(json_decode($request->subjectscollege_id) as $subject){
        $ds =  new Doctor_Subcollege;
        $ds->doctor_id = $user->id;
        $ds->subcollege_id = $subject;
        $ds->save();
        }
           foreach(json_decode($request->division_id) as $subject){
        $dd =  new Doctor_Division;
        $dd->doctor_id = $user->id;
        $dd->division_id = $subject;
        $dd->save();
        }
         foreach(json_decode($request->section_id) as $subject){
        $ds2 =  new Doctor_Section;
        $ds2->doctor_id = $user->id;
        $ds2->section_id = $subject;
        $ds2->save();
        }
          $permissions = Permission::get()->pluck('id');
    if($permissions){
        $user->syncPermissions($permissions);
        }
        return response()->json(['status' => true]);
			}else{
			     return response()->json(['status' => false,'message' => $validator->messages()->first()]);
			}
 }
 public function doctors(){
     if(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
         $doctors = User::where('id',auth()->user()->id)->first()->doctors; 
     }else{
         $doctors = User::where('is_student',3)->get();
     }
     return view('dashboard.doctors')->with('doctors',$doctors);
 } public function editdoctor($id){
   $doctor = User::where('id',$id)->firstOrFail();
     return view('dashboard.editdoctor')->
     with('subjectscollegs',SubjectsCollege::all())->with('colleges',College::all())->with('divisions',Division::all())->
     with('sections',Section::all())
     ->with('states',State::all())->with('cities',City::all())->with('subcolleges',SubjectsCollege::all())->with('universities',University::all())->with('doctor',$doctor);
 }
 public function updatedoctor($id,Request $request){
   
    $validator = Validator::make($request->all(),[
        'name' => "required|unique:users,name,$id",
        'phone' => "required|unique:users,phone,$id|numeric",
      'state_id' => 'required',
      'address' => 'required',
      'city_id' => 'required',
      'email' => "required|unique:users,email,$id",
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' =>  ' هذا الحقل يقبل صوره فقط',
        'phone.numeric' => ' رقم الهاتف يقبل رقما فقط',
        'phone.unique' => 'هذا الرقم  مستخدم من قبل',
        'email.unique' => ' هذا الايميل موجود من قبل',
        'name.unique' => 'اسم المستخدم موجود من  قبل ',
        'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
		'image.required' => 'حقل الصوره مطلوب'
             ]);
   
             if($validator->passes())
			{
     	$user =  User::where('id',$id)->first();
               if($request->password){
			$user->password = Hash::make($request->password);
               }
			$user->name=$request->name;
			$user->phone=$request->phone;
			$user->state_id = $request->state_id;
			$user->city_id = $request->city_id;
			$user->address = $request->address;
		   $user->is_student=3;
			$user->description=$request->description;
			$user->email=$request->email;
			$user->college_id = $request->college_id;
			$user->university_id = $request->university_id;
		 	 	if($request->hasFile('cover_image'))
        {
            $cover_image = $request->cover_image;
            $cover_image->move('uploads' ,time(). $cover_image->getClientOriginalName());
            $user->cover_image =time(). $request->cover_image->getClientOriginalName();
        }
		
			if($request->hasFile('printsplash'))
        {
            $printsplash = $request->printsplash;
            $printsplash->move('uploads' ,time(). $printsplash->getClientOriginalName());
            $user->printsplash =time(). $request->printsplash->getClientOriginalName();
        }	if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time().$image->getClientOriginalName());
            $user->image = time().$request->image->getClientOriginalName();
        }	if($request->hasFile('intro'))
        {
            $intro = $request->intro;
            $intro->move('uploads' , time().$intro->getClientOriginalName());
            $user->intro = time().$request->intro->getClientOriginalName();
        }
         $user->save();
          if(Auth::user() && Auth::user()->is_student == 5 && Auth()->user()->category_id == 2){
          $cu = new Center_Doctor;
          $cu->center_id = auth()->user()->id;
          $cu->doctor_id = $user->id;
          $cu->save();
       }
               
                 if(count($user->subcolleges) > 0){
   Doctor_Subcollege::where('doctor_id',$id)->get()->each(function ($sub) {
            $sub->delete();
        });
                 }
        foreach(json_decode($request->subjectscollege_id) as $subject){
        $ds =  new Doctor_Subcollege;
        $ds->doctor_id = $id;
        $ds->subcollege_id = $subject;
        $ds->save();
        }
                
                 if(count($user->divisions) > 0){
   Doctor_Division::where('doctor_id',$id)->get()->each(function ($sub) {
            $sub->delete();
        });
   }
           foreach(json_decode($request->division_id) as $subject){
        $dd =  new Doctor_Division;
        $dd->doctor_id = $id;
        $dd->division_id = $subject;
        $dd->save();
        }
                 if(count($user->sections) > 0){
   Doctor_Section::where('doctor_id',$id)->get()->each(function ($sub) {
            $sub->delete();
        });
   }
         foreach(json_decode($request->section_id) as $subject){
        $ds2 =  new Doctor_Section;
        $ds2->doctor_id = $user->id;
        $ds2->section_id = $subject;
        $ds2->save();
        }
          $permissions = Permission::get()->pluck('id');
    if($permissions){
        $user->syncPermissions($permissions);
        }
        return response()->json(['status' => true]);
			}else{
			     return response()->json(['status' => false,'message' => $validator->messages()->first()]);
			}
 }public function getdoctor($id){
   $doctors_ids = Doctor_Subcollege::where('subcollege_id',$id)->get()
    ->pluck('doctor_id')->toArray();
    if(Auth::user() &&Auth::user()->is_student == 5 &&
    Auth::user()->category_id == 2){
    $doctors1 = User::whereIn('id',$doctors_ids)->get();
        $doctors2= User::where('id',auth()->user()->id)->first()->doctors;
      $doctors = $doctors1->intersect($doctors2);
    }else{
    $doctors = User::whereIn('id',$doctors_ids)->get();}
    $text = "";
        $text .='<option value="0" selected="selected"  disabled="disabled">اختر دكتور</option>';
               foreach($doctors as $doctor){
                       $text .= '<option value="'.$doctor->id.'">'.$doctor->name.'</option>';
            }
            return response()->json($text);
}
}