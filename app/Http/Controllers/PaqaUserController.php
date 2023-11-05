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
class PaqaUserController extends Controller
{
    public function addpaqabasic(){
     return view('dashboard.addpaqabasic')->with("user",User::where([
         ['is_student','=',5],['category_id','=',1]])->orWhere('is_student',2)->get())->

     with("paqa",Paqa::orderBy('created_at', 'desc')->get());
 }
  public function addpaqacollage(){
     return view('dashboard.addpaqacollage')->with("user",User::where([
         ['is_student','=',5],['category_id','=',2]])->orWhere('is_student',3)->get())->
     with("paqa",Paqa::orderBy('created_at', 'desc')->get());
 }
  public function addpaqapublic(){
     return view('dashboard.addpaqapublic')->with("user",User::where([
         ['is_student','=',5],['category_id','=',3]])->orWhere('is_student',4)->get())->
     with("paqa",Paqa::orderBy('created_at', 'desc')->get());
 } 
  public function editpaqabasic($id){
       $poo = Paqa_User::where('id',$id)->first();
     return view('dashboard.editpaqauser')->with("user",User::where([
         ['is_student','=',5],['category_id','=',1]])->orWhere('is_student',2)->get())->

     with("paqa",Paqa::orderBy('created_at', 'desc')->get())->with('p',$poo);
 }
  public function editpaqacollage($id){
       $poo = Paqa_User::where('id',$id)->first();
     return view('dashboard.editpaqauser')->with("user",User::where([
         ['is_student','=',5],['category_id','=',2]])->orWhere('is_student',3)->get())->
     with("paqa",Paqa::orderBy('created_at', 'desc')->get())->with('p',$poo);
 }
  public function editpaqapublic($id){
       $poo = Paqa_User::where('id',$id)->first();
     return view('dashboard.editpaqauser')->with("user",User::where([
         ['is_student','=',5],['category_id','=',3]])->orWhere('is_student',4)->get())->
     with("paqa",Paqa::orderBy('created_at', 'desc')->get())->with('p',$poo);
 } public function updatepaqauser(Request $request,$id){
	 $validator = Validator::make($request->all(),[
	 'user_id' => 'required',
	'paqa_id' => 'required' 
	 ],[
	 'user_id.unique' => 'حقل المدرس مطلوب',
		'paqa_id.unique' => 'حقل الباقه مطلوب'
	 ]);
	 if($validator->passes()){
      $poo = Paqa_User::where('id',$id)->first();
              $paqa = Paqa::where('id',$request->paqa_id)->first();
           $value=$paqa->value;
           $type=$paqa->type;
           
           if($type==1){
             
                $mydate=Carbon::now()->toDateString();
                $daystosum = $paqa->value;
                $date= date('Y-m-d', strtotime($mydate.' + '.$daystosum.' days'));
                
                
           }elseif($type==2){
                 
                $mydate=Carbon::now()->toDateString();
                $num= $paqa->value;
                $num2="30";
                $daystosum = $num*$num2;
                 $date= date('Y-m-d', strtotime($mydate.' + '.$daystosum.' days'));
           }elseif($type==3){
               
               $mydate=Carbon::now()->toDateString();
               $num= $paqa->value;
               $num2="365";
               $daystosum = $num*$num2;
                $date= date('Y-m-d', strtotime($mydate.' + '.$daystosum.' days'));
           }
        $poo->expired_at =$date;
        $poo->paqa_id = $request->paqa_id;
        $poo->user_id = $request->user_id;
        $poo->date = Carbon::now()->toDateString();
        $poo->save();
        
        return response()->json(['status' => true]);
 }else{
 $msg= $validator->messages()->first();
	 return response()->json(['status' => false,'message' => $msg]);
	 }
 }
 public function storepaqasuser(Request $request){
	 $validator = Validator::make($request->all(),[
	 'user_id' => 'required',
	'paqa_id' => 'required' 
	 ],[
	 'user_id.unique' => 'حقل المدرس مطلوب',
		'paqa_id.unique' => 'حقل الباقه مطلوب'
	 ]);
	 if($validator->passes()){
      $po = Paqa_User::where('user_id',$request->user_id)->first();
     
        if($po !== null){
            // dd("khkjh");
      // $paqa= Paqa::where('id',$po->paqa_id)->first();
        $po->paqa_id = $request->paqa_id;
        $po->user_id = $request->user_id;
        $po->date = Carbon::now()->toDateString();
        $po->save();
       }
       else{
        $poo = new Paqa_User;
              $paqa = Paqa::where('id',$request->paqa_id)->first();
    //   if($paqa ==null){
    //      $poo->expired_at = null;
 
    //   }else{
           $value=$paqa->value;
           $type=$paqa->type;
           
           if($type==1){
             
                $mydate=Carbon::now()->toDateString();
                $daystosum = $paqa->value;
                 $date= date('Y-m-d', strtotime($mydate.' + '.$daystosum.' days'));
           }elseif($type==2){
                 
                $mydate=Carbon::now()->toDateString();
                $num= $paqa->value;
                $num2="30";
                $daystosum = $num*$num2;
                 $date= date('Y-m-d', strtotime($mydate.' + '.$daystosum.' days'));
           }elseif($type==3){
               
               $mydate=Carbon::now()->toDateString();
               $num= $paqa->value;
               $num2="365";
               $daystosum = $num*$num2;
                $date= date('Y-m-d', strtotime($mydate.' + '.$daystosum.' days'));
           }
        $poo->expired_at =$date;
        $poo->paqa_id = $request->paqa_id;
        $poo->user_id = $request->user_id;
        $poo->date = Carbon::now()->toDateString();
        $poo->save();
        
       }
        return response()->json(['status' => true]);
 }else{
 $msg= $validator->messages()->first();
	 return response()->json(['status' => false,'message' => $msg]);
	 }
 }
 public function userpaqabasic(){
    
     $id=Paqa_User::pluck('user_id')->toArray();
    
     return view('dashboard.userpaqabasic')->with("user",User::where([
         ['is_student','=',5],['category_id','=',1]])->orWhere('is_student',2)->whereIn('id',$id)->orderBy('created_at', 'desc')->get())->with("type",1);
 }
  public function userpaqacollage(){
     
     $id=Paqa_User::pluck('user_id')->toArray();
    
     return view('dashboard.userpaqabasic')->with("user",User::where([
         ['is_student','=',5],['category_id','=',2]])->orWhere('is_student',3)->whereIn('id',$id)->orderBy('created_at', 'desc')->get())->with("type",2);
 }
  public function userpaqapublic(){
     
     $id=Paqa_User::pluck('user_id')->toArray();
    
     return view('dashboard.userpaqabasic')->with("user",User::where([
         ['is_student','=',5],['category_id','=',3]])->orWhere('is_student',4)->whereIn('id',$id)->orderBy('created_at', 'desc')->get())->with("type",3);
 }
}