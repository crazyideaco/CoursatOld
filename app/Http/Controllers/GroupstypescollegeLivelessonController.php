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
use App\GroupTypescollege;
use App\GroupstypescollegeLivelesson;
class GroupstypescollegeLivelessonController extends Controller
{
  public function grouptypescollegelivelessons($id){
    $lessons = GroupstypescollegeLivelesson::where('grouptypescollege_id',$id)->get();
    return view("dashboard.groupstypescollegelivelessons.index")->with("lessons",$lessons)->with('id',$id);
    
  }public function addgrouptypescollegelivelesson($id){
    return view("dashboard.groupstypescollegelivelessons.create")->with('id',$id);
  }public function storegrouptypescollegelivelesson(Request $request,$id){
   $group = GroupTypescollege::where('id',$id)->first();
    $lesson = new GroupstypescollegeLivelesson;
    $lesson->grouptypescollege_id  = $id;
      $lesson->university_id = $group->university_id;
      $lesson->college_id = $group->college_id;
      $lesson->division_id  = $group->division_id;
      $lesson->section_id  = $group->section_id;
      $lesson->subjectscollege_id = $group->subjectscollege_id;
    $lesson->typescollege_id  = $group->typescollege_id ;
    $lesson->name_ar = $request->name_ar;
    $lesson->date_lesson = $request->date_lesson;
    $lesson->start_time = $request->start_time;
    $lesson->save();
    return redirect("grouptypescollegelivelessons/$id");
  }public function editgrouptypescollegelivelesson($id){
    $lesson = GroupstypescollegeLivelesson::where('id',$id)->first();
    return view("dashboard.groupstypescollegelivelessons.edit")->with('lesson',$lesson);
  }public function updategrouptypescollegelivelesson(Request $request,$id){
   
   $lesson = GroupstypescollegeLivelesson::where('id',$id)->first();
     $lesson->name_ar = $request->name_ar;
    $lesson->date_lesson = $request->date_lesson;
    $lesson->start_time = $request->start_time;
    $lesson->save();;
    return redirect("grouptypescollegelivelessons/$lesson->grouptypescollege_id");
  }public function deletegrouptypescollegelivelesson($id){
    $lesson = GroupstypescollegeLivelesson::where('id',$id)->first();
     $lesson->delete();
    return response()->json(['status' => true]);
  }
}