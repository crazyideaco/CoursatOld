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
use App\GroupCourse;
class GroupCourseController extends Controller
{
  public function groupcourses($id){
    $groups = GroupCourse::where('course_id',$id)->get();
    return view("dashboard.groupcourses.index")->with("groups",$groups)->with('id',$id);
    
  }public function addgroupcourse($id){
    return view("dashboard.groupcourses.create")->with('id',$id);
  }public function storegroupcourse(Request $request,$id){
   $course = Course::where('id',$id)->first();
    $group = new GroupCourse;
    $group->course_id = $id;
    $group->sub_id = $course->sub_id;
     $group->general_id = $course->general_id;
    $group->name_ar = $request->name_ar;
    $group->save();
    return redirect("groupcourses/$id");
  }public function editgroupcourse($id){
    $group = groupcourse::where('id',$id)->first();
    return view("dashboard.groupcourses.edit")->with('group',$group);
  }public function updategroupcourse(Request $request,$id){
   
   $group = groupcourse::where('id',$id)->first();
    $group->name_ar = $request->name_ar;
    $group->save();
    return redirect("groupcourses/$group->course_id");
  }public function deletegroupcourse($id){
     $group = groupcourse::where('id',$id)->first();
     $group->delete();
    return response()->json(['status' => true]);
  }public function addgroupcoursestudent($id){
    $group = groupcourse::where('id',$id)->first();
     $course = Course::where('id',$group->course_id)->first();
    return view("dashboard.groupcoursestudents.create")->with("students",$course->studentscourses)->with('group',$group);
  }public function storegroupcoursestudent(Request $request,$id){
    $group = groupcourse::where('id',$id)->first();
  
      $group->students()->sync($request->students);
   
     return redirect("groupcoursestudents/$id");
  //   $type = Type::where('id',$group->course_id)->first();
   // return view("dashboard.groupcoursestudents.create")->with("students",$type->studentstype)->with('id',$id);
  }public function groupcoursestudents ($id){
      $group = groupcourse::where('id',$id)->first();
       return view("dashboard.groupcoursestudents.index")->with("students",$group->students)->with('id',$id);
  }
}