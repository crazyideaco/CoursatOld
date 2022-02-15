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
class FilterCourseController extends Controller
{
  public function filtertypes(Request $request){
  if($request->years_id && $request->subjects_id){
    $types = Type::where('subjects_id',$request->subjects_id)->get();
  }else if($request->years_id){
     $types = Type::where('years_id',$request->years_id)->get();
  }
    $text="";
    foreach($types as $type){
      $text .= '<tr id="type'.$type->id.'">
					<!--	  <td class="text-center">'.$type->id.'</td>-->
                    <td scope="row" class="text-center"><a href="'.route("subtypes",$type->id).'">'.$type->name_ar.'</a></td>
                      <td class="text-center">';
                        if($type->user){
                       $text .= $type->user->name;
                        }
                      $text .='</td>
                        <td class="text-center">';
                          if($type->subject){
                          $text .= $type->subject->name_ar;
                          }
                   $text .= '</td>
                          <td class="text-center">';
                            if($type->year){
                            $text .=$type->year->year_ar;
                            }
      $text .='</td>
                        <td class="text-center">
                          <a href="'.route("edittype",$type->id).'"> <img src="'.asset("images/pen.svg").'" id="pen" 
                         style="cursor: pointer"></a>
                             <img src="'.asset("images/trash.svg").'" id="trash" onclick="deletetype('.$type->id.')" style="cursor:pointer;"> 
                         <span class="btn bg-success btn-success text-white btn-sm" id="btn'.$type->id.'" onclick="activetype('.$type->id.')">';
                             if($type->active == 1){
                          $text .= "الغاء التفعيل";
                             }
                             else{
                          $text .=   "تفعيل";
                             }
                            
                        $text .='</span>
                           <a href="'.route("grouptypes",$type->id).'" class="btn btn-success btn-sm" >المجموعات</a>
                           <a href="'.route("typeexams",$type->id).'" class="btn btn-success btn-sm" >الامتحانات</a>
                                            </td>
                                        </tr>';                     
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function filtertypescollege(Request $request){
  if($request->university_id && $request->college_id && $request->division_id && $request->section_id && $request->subjectscollege_id){
       $typescolleges = TypesCollege::where("subjectscollege_id",$request->subjectscollege_id)->get();
  }elseif($request->university_id && $request->college_id && $request->division_id && $request->section_id){
       $typescolleges = TypesCollege::where("section_id",$request->section_id)->get();
  }elseif($request->university_id && $request->college_id && $request->division_id){
       $typescolleges = TypesCollege::where("division_id",$request->division_id)->get();
  }elseif($request->university_id && $request->college_id){
       $typescolleges = TypesCollege::where("college_id",$request->college_id)->get();
  }elseif($request->university_id){
       $typescolleges = TypesCollege::where("university_id",$request->university_id)->get();
  }else{
    $typescolleges = TypesCollege::all();
  }
    $text = "";
                        foreach($typescolleges as $typescollege){
                     $text .= '<tr id="un'.$typescollege->id.'">
					<!--	<td>'.$typescollege->id.'</td>-->
                          <td scope="row" class="text-center">
                   <a href="'.route("lessons",$typescollege).'"> '.$typescollege->name_ar.'</a></td>
                   
                   <td scope="row" class="text-center">
                   '.$typescollege->subjectscollege->name_ar.'</td>
                   <td scope="row" class="text-center">
                   '.$typescollege->section->name_ar.'</td>
                <td scope="row" class="text-center">
                   '.$typescollege->division->name_ar.'</td>
                    <td class="text-center">'.$typescollege->college->name_ar.'</td>
                          <td class="text-center">'.$typescollege->university->name_ar.'</td>
                        <td class="text-center">
                  <a href="'.route("edittypescollege",$typescollege->id).'"> <img src="'.asset("images/pen.svg").'" id="pen" 
                         style="cursor: pointer"></a>
                           <span class="btn bg-success text-white btn-sm btning" id="now'.$typescollege->id.'" onclick="activetypecollege('.$typescollege->id.')">';
							   							
                             if($typescollege->active == 1){
                                                   $text .= "الغاء التفعيل";
                             }else{
                                $text .=   "تفعيل";
                             }
                        $text .='</span>
                           <a  href="'.route("groupstypescollege",$typescollege->id).'" class="btn bg-success text-white btn-sm btning">المجموعات</a>
							 <img src="'.asset("images/trash.svg").'" id="trash" onclick="deletetypescollege('.$typescollege->id.')" style="cursor:pointer;"> 
                              <a class="btn btn-primary btn-sm mt-2" href="'.route("typescollegeexams",$typescollege->id).'">
                          الامتحانات
                         </a>
                                            </td>
                                        </tr>';                           
                        }
     return response()->json(['status' => true,'data' => $text]);
  }public function filtercourses(Request $request){
    if($request->sub_id){
      $courses = Course::where("sub_id",$request->sub_id)->get();
    }   
    $text = '';
    foreach($courses as $course){
                  $text .='<tr id="g'.$course->id.'">
						<!--<td class="text-center">'.$course->id.'</td>-->
                <td scope="row" class="text-center">
                 <a href="'.route("videosgeneral",$course->id).'">  '.$course->name_ar.'</a></td>
                    <td class="text-center">'.$course->user->name.'</td>
                       <td class="text-center">'.$course->general->name_ar.'</td>
                         <td class="text-center">'.$course->sub->name_ar.'</td>
                        <td class="text-center">
                  <a href="'.route("editcourse",$course->id).'"> <img src="'.asset("images/pen.svg").'" id="pen" 
                         style="cursor: pointer"></a>
                           <img src="'.asset("images/trash.svg").'" id="trash" onclick="deletecourse('.$course->id.')" style="cursor:pointer;"> 
                         <span class="btn bg-success text-white btn-sm" id="btn'.$course->id.'" onclick="activecourse('.$course->id.')">';
                             if($course->active == 1){
                                                 $text .= "الغاء التفعيل";
                             }else{
                                $text .=   "تفعيل";
                             }
                          $text .='</span>
                          <a  href="'.route('groupcourses',$course->id).'" class="btn bg-success text-white btn-sm">المجموعات</a>
                             <a class="btn btn-primary btn-sm mt-2" href="'.route("courseexams",$course->id).'">
                          الامتحانات
                         </a>
                           </td>
                                        </tr>';                          
    }
     return response()->json(['status' => true,'data' => $text]);
  }
}