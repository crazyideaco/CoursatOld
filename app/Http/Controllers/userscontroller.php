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
class userscontroller extends Controller
  {
  public function deleteuser($id){
    $user = User::where('id',$id)->first();
    $user->delete();
    return response()->json(['status' => true]);
  } 
public function activeuser($id){
     $user = User::where('id',$id)->first();
     if($user->active == 1){
         $user->active = 0;
         $user->save();
         return response(['status' => 'deactive']);
     }else if($user->active == 0){
         $user->active = 1;
         $user->save();
         return response(['status' => 'active']);
     }
 } 
 public function phone_verify($id){
     $user = User::where('id',$id)->first();
    
         $user->phone_verify = 1;
         $user->save();
         return response(['status' => true]);
     
 } 
}