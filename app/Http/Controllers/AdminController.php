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
class AdminController extends Controller
{
     public function __construct()
    {
      $this->middleware(['permission:admins-create'])->only('addadmin');
        $this->middleware(['permission:admins-read'])->only('admins');
       $this->middleware(['permission:admins-update'])->only('editadmin');
       $this->middleware(['permission:admins-delete'])->only('destroy');
    }
  public function addadmin(){
	return view('dashboard.admins.addadmin');}
	public function storeadmin(Request $request){
	$request->validate([
	'name' => 'required|unique:users',
	'email'=> 'required|unique:users',
	'password'=> 'required',
	'phone' => 'required|unique:users'
	],[
	'required'=> 'هذا الحقل مطلوب',
	'name.unique' => 'هذا الاسم موجود من قبل',
	'phone.unique' => 'هذا الهاتف موجود من قبل',
	'email.unique' => 'هذا الايميل موجود من قبل',
	]);
		$user = new User;
		$user->name = $request->name;
		$user->phone = $request->phone;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->isAdmin = 'admin';
		$user->save();
         if($request->permissions){
        $user->attachPermissions($request->permissions);
        }
		return redirect()->route('admins');
	}public function editadmin($id){
		$admin = User::where('id',$id)->first();
	return view('dashboard.admins.editadmin')->with('admin',$admin);}
	public function updateadmin(Request $request,$id){
	$request->validate([
	'name' => "required|unique:users,name,$id",
	'email'=> "required|unique:users,email,$id",
	//'password'=> 'required',
	'phone' => "required|unique:users,phone,$id"
	],[
	'required'=> 'هذا الحقل مطلوب',
	'name.unique' => 'هذا الاسم موجود من قبل',
	'phone.unique' => 'هذا الهاتف موجود من قبل',
	'email.unique' => 'هذا الايميل موجود من قبل',
	]);
		$user = User::where('id',$id)->first();
		$user->name = $request->name;
		$user->phone = $request->phone;
		$user->email = $request->email;
      if($request->password){
		$user->password = Hash::make($request->password);
      }
		$user->isAdmin = 'admin';
		$user->save();
        if($request->permissions){
        $user->syncPermissions($request->permissions);
        }
		return redirect()->route('admins');
	}public function admins(){
	$admins = User::where([["isAdmin",'=','admin']])->get();
	return view('dashboard.admins.admins')->with("admins",$admins);}
}