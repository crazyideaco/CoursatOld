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
use App\GroupType;
use App\GroupTypescollege;
use App\TypescollegeGroupDay;
use App\Day;
class GroupTypescollegeController extends Controller
{
  public function groupstypescollege($id){
    $groups = GroupTypescollege::where('typescollege_id',$id)->get();
    return view("dashboard.groupstypescollege.index")->with("groups",$groups)->with('id',$id);
    
  }public function addgroupstypescollege($id){
      $days = Day::all();
    return view("dashboard.groupstypescollege.create")->with('id',$id)->with("days",$days);
  }public function storegroupstypescollege(Request $request,$id){
   $type = TypesCollege::where('id',$id)->first();
    $group = new GroupTypescollege;
    $group->typescollege_id  = $id;
    $group->university_id = $type->university_id;
    $group->college_id = $type->college_id;
    $group->division_id  = $type->division_id;
    $group->section_id  = $type->section_id;
     $group->subjectscollege_id  = $type->subjectscollege_id;
    $group->name_ar = $request->name_ar;
    $group->save();
      if($request->day_id){
    foreach($request->day_id as $key => $day_id){
      $day = new TypescollegeGroupDay;
      $day->day_id = $day_id;
      $day->group_id = $group->id;
      $day->from_time = $request->from_time[$key];
      $day->to_time = $request->to_time[$key];
      $day->save();
    }}
    return redirect("groupstypescollege/$id");
  }public function editgroupstypescollege($id){
      $days = Day::all();
    $group = GroupTypescollege::where('id',$id)->first();
    return view("dashboard.groupstypescollege.edit")->with('group',$group)->with("days",$days);
  }public function updategroupstypescollege(Request $request,$id){
   
   $group = GroupTypescollege::where('id',$id)->first();
    $group->name_ar = $request->name_ar;
    $group->save();
         if($request->day_id){
           TypescollegeGroupDay::where('group_id',$group->id)->delete();
    foreach($request->day_id as $key => $day_id){
      $day = new TypescollegeGroupDay;
      $day->day_id = $day_id;
      $day->group_id = $group->id;
      $day->from_time = $request->from_time[$key];
      $day->to_time = $request->to_time[$key];
      $day->save();
    }}
    return redirect("groupstypescollege/$group->typescollege_id");
  }public function deletegroupstypescollege($id){
     $group = GroupTypescollege::where('id',$id)->first();
     $group->delete();
    return response()->json(['status' => true]);
  }public function addgroupstypescollegestudent($id){
    $group = GroupTypescollege::where('id',$id)->first();
     $type = TypesCollege::where('id',$group->typescollege_id)->first();
    return view("dashboard.groupstypecollegestudents.create")->with("students",$type->studentscollege)->with('group',$group);
  }public function storegroupstypescollegestudent(Request $request,$id){
    $group = GroupTypescollege::where('id',$id)->first();
  
      $group->students()->sync($request->students);
   
     return redirect("groupstypescollegestudents/$id");
  //   $type = Type::where('id',$group->type_id)->first();
   // return view("dashboard.groupstypestudents.create")->with("students",$type->studentstype)->with('id',$id);
  }public function groupstypescollegestudents ($id){
      $group = GroupTypescollege::where('id',$id)->first();
       return view("dashboard.groupstypecollegestudents.index")->with("students",$group->students)->with('id',$id);
  }
}