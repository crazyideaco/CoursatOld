<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\WebsiteStudent;
use App\User;
use App\WebsiteStudentCourse;

use Illuminate\Support\Facades\Hash;
class WebsiteStudentController extends Controller
{
    
  public function create(){
    $users = User::whereIn("is_student",[2,3,4])->select("id","name")->get();
	return view('dashboard.website_students.create',compact("users"));
}

	public function store(Request $request){
	$request->validate([
	'name' => 'required',
	'password'=> 'required',
	'phone' => 'required|unique:website_students'
	],[
	'required'=> 'هذا الحقل مطلوب',
	'name.unique' => 'هذا الاسم موجود من قبل',
	'phone.unique' => 'هذا الهاتف موجود من قبل'	]);
    $user = User::where("id",$request->user_id)->first();

    if($user->is_student == 2){
        $type = 1;
    }
    if($user->is_student == 3){
        $type = 2;
    }
    if($user->is_student == 4){
        $type = 3;
    }
		$website_student =  WebsiteStudent::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "user_id" => $request->user_id,
            "type" => $type,
            "password" => Hash::make($request->password)

        ]);
        foreach($request->course_ids as $course_id){
        WebsiteStudentCourse::create([
            "course_id" => $course_id,
            "website_student_id" => $website_student->id,
            "type" => $type 
        ]);

        }
	
		return redirect()->route('website_students');
	}

	public function index(){
	$website_students = WebsiteStudent::get();
	return view('dashboard.website_students.index')->with("website_students",$website_students);
}
public function get_filter_user_courses($id){
    $user = User::where("id",$id)->first();
    if($user->is_student == 2){
        $types = $user->types;
    }
    if($user->is_student == 3){
        $types = $user->typescollege;
    }
    if($user->is_student == 4){
        $types = $user->courses;
    }
    $text = "";
    foreach($types as $type){
        $text .='<option value="'.$type->id.'">'.$type->name_ar.'</option>';    }

        return response()->json(["status" => true,"data" => $text]);
}
}