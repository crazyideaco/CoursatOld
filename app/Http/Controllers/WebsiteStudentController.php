<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\WebsiteStudent;
use App\User;

use Illuminate\Support\Facades\Hash;
class WebsiteStudentController extends Controller
{
    
  public function create(){
    $users = User::whereIn("id",[2,3,4])->select("id","name")->get();
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
		$user = new WebsiteStudent;
		$user->name = $request->name;
		$user->phone = $request->phone;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->isAdmin = 'admin';
		$user->save();
       
		return redirect()->route('admins');
	}

	public function index(){
	$website_students = User::get();
	return view('dashboard.website_students.index')->with("website_students",$website_students);
}
}