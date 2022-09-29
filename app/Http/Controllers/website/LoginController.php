<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;
use App\Http\Requests\Website\Auth\LoginRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(){
        return view('website.login');}
        public function signin(Request $request){
            $request->validate([
                "phone" => "required",
                "password" => "required"
            ]);
            $user = User::wherePhone($request->phone)->first();
            if(!$user){
               return redirect()->back()->with(['error'=> 
               "لا يوجد مستخدم بهذ الرقم"]);
            }
            if (auth()->guard("website_student")->attempt(['phone' => 
            $request->phone, 'password' => $request->password]
            )){
               dd(true);
               
            }else{
               return redirect()->back()->with(['error'=> 
               "كلمه السر خاطئه"]);
            }
           }
           public function logout(){
               auth()->guard("website_student")->logout();
           
             return redirect()->route('login_website')->with(['success'=> "تم تسجيل الخروج بنجاح"]);
           }
}