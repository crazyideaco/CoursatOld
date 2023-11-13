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
use App\GroupscourseLivelesson;
class GroupscourseLivelessonController extends Controller
{
  public function groupcourselivelessons($id){
    $lessons = GroupscourseLivelesson::where('groupcourse_id',$id)->get();
    return view("dashboard.groupcourseslivelessons.index")->with("lessons",$lessons)->with('id',$id);
    
  }public function addgroupcourselivelesson($id){
    return view("dashboard.groupcourseslivelessons.create")->with('id',$id);
  }public function storegroupcourselivelesson(Request $request,$id){
   $group = GroupCourse::where('id',$id)->first();
    $lesson = new GroupscourseLivelesson;
    $lesson->groupcourse_id  = $id;
      $lesson->course_id = $group->course_id;
    $lesson->general_id = $group->general_id;
     $lesson->sub_id = $group->sub_id;
    $lesson->name_ar = $request->name_ar;
    $lesson->date_lesson = $request->date_lesson;
      $lesson->start_time = $request->start_time;
    $lesson->save();
    return redirect("groupcourselivelessons/$id");
  }public function editgroupcourselivelesson($id){
    $lesson = GroupscourseLivelesson::where('id',$id)->first();
    return view("dashboard.groupcourseslivelessons.edit")->with('lesson',$lesson);
  }public function updategroupcourselivelesson(Request $request,$id){
   
   $lesson = GroupscourseLivelesson::where('id',$id)->first();
     $lesson->name_ar = $request->name_ar;
    $lesson->date_lesson = $request->date_lesson;
    $lesson->start_time = $request->start_time;
    $lesson->save();;
    return redirect("groupcourselivelessons/$lesson->groupcourse_id");
  }public function deletegroupcourselivelesson($id){
    $lesson = GroupscourseLivelesson::where('id',$id)->first();
     $lesson->delete();
    return response()->json(['status' => true]);
  }
}