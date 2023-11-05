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
use App\SubjectQuestion;
use App\SubjectquestionAnswer;
use App\SubjectPart;
class SubjectQuestionCenterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:subjectquestionsscenter-create'])->only('addsubjectquestionscenter');
        $this->middleware(['permission:subjectquestionsscenter-read'])->only('subjectquestionsscenter');
        $this->middleware(['permission:subjectquestionsscenter-update'])->only('editsubjectquestionscenter');
         $this->middleware(['permission:subjectquestionsscenter-delete'])->only('deletesubjectquestionscenter');
    }
  public function addsubjectquestionscenter(){
     if(Auth::user() && Auth::user()->isAdmin == 'admin'){
       $users =  User::where('is_student',2)->get();
       $subjects = Subject::all();
     }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
		 $users =  User::where('center_id',Auth::user()->id)->where('is_student',2)->get();
		 $subjects = Subject::all();
      }else if(Auth::user() && Auth::user()->is_student == 2){
          $users = "";
           $subjects = User::where('id',auth()->user()->id)->first()->subjects;
      }
    return view("dashboard.subjectsquestions.subjectsquestionscenter.create")->with('years',Year::all())->with('subjects',$subjects)
     ->with('stages',Stage::all())->with('users',$users);
  }public function storesubjectquestionscenter(Request $request){
    $part = new SubjectPart;
    $part->years_id = $request->years_id;
    $part->subjects_id = $request->subjects_id;
    $part->name = $request->part;
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
       $part->admin = 1;
      }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
          $part->teacher_id  = $request->teacher_id;
          $part->center_id  = auth()->id();
       }else if(Auth::user() && Auth::user()->is_student == 2){
        $part->teacher_id  = auth()->id();
       }
    $part->save();
    foreach($request->name as $key1 => $name){
    $question = new SubjectQuestion;
    $question->years_id = $request->years_id;
    $question->subjects_id = $request->subjects_id;
    $question->name = $name;
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $question->public = 1;
       }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
           $question->teacher_id  = $request->teacher_id;
           $question->public = 0;
           $question->center_id  = auth()->id();
        }else if(Auth::user() && Auth::user()->is_student == 2){
         $part->teacher_id  = auth()->id();
         $question->public = 0;
        }
      $question->subjectpart_id = $part->id;
    $question->score = $request->score[$key1];
    $question->question_level = $request->question_level[$key1];
    
       if($request->video[$key1]){
               $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('video')[$key1]);

$duration =  $file['playtime_seconds'];
     $question->video_sec = $duration;
        $url = $request->video[$key1];
    // $video->size_video= $request->file('video')->getSize()/1024;
        $url->move('uploads' , time(). '.'.$url->getClientOriginalExtension());
        $question->video = time(). '.'.$url->getClientOriginalExtension();

    } 
         if($request->question_image[$key1])
    {
        $image = $request->question_image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->question_image = time().$image->getClientOriginalName();
    } 
    if( $request->image[$key1])
    {
        $image = $request->image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->image = time().$image->getClientOriginalName();
    }   
    $question->notes = $request->notes[$key1];
    $question->save();
    foreach($request->answer[$key1] as $key => $value){
    $questionanswer1 = new SubjectquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subjectquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    return response()->json(['success' => 'question uploaded']);
  } 
  public function subjectquestionsscenter(){
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $questions = SubjectPart::where('admin',1)->get();
      }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
        $questions = SubjectPart::where('center_id',Auth::user()->id)->get();
       }else if(Auth::user() && Auth::user()->is_student == 2){
           $questions = SubjectPart::where('teacher_id',auth()->user()->id)->get();
       }
    return view("dashboard.subjectsquestions.subjectsquestionscenter.index")->with("questions",$questions)->with('stages',Stage::all());
    
  }  public function editsubjectquestionscenter($id){
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $users =  User::where('is_student',2)->get();
        $subjects = Subject::all();
      }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
          $users =  User::where('center_id',Auth::user()->id)->where('is_student',2)->get();
          $subjects = Subject::all();
       }else if(Auth::user() && Auth::user()->is_student == 2){
           $users = "";
            $subjects = User::where('id',auth()->user()->id)->first()->subjects;
       }
    $part = SubjectPart::where('id',$id)->first();
    return view("dashboard.subjectsquestions.subjectsquestionscenter.edit")->with('part',$part)->with('years',Year::all())->with('subjects',$subjects)
    ->with('stages',Stage::all())->with('users',$users);
  }public function updatesubjectquestionscenter(Request $request,$id){
    
    $part =  SubjectPart::where('id',$id)->first();
    $part->years_id = $request->years_id;
    $part->subjects_id = $request->subjects_id;
    $part->name = $request->part;
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
       $part->admin = 1;
      }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
          $part->teacher_id  = $request->teacher_id;
          $part->center_id  = auth()->id();
       }else if(Auth::user() && Auth::user()->is_student == 2){
        $part->teacher_id  = auth()->id();
       }
    $part->save();
    if($request->name){
      SubjectQuestion::where('subjectpart_id',$id)->delete();
    foreach($request->name as $key1 => $name){
    $question = new SubjectQuestion;
    $question->years_id = $request->years_id;
    $question->subjects_id = $request->subjects_id;
    $question->name = $name;
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $question->public = 1;
       }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
           $question->teacher_id  = $request->teacher_id;
           $question->public = 0;
           $question->center_id  = auth()->id();
        }else if(Auth::user() && Auth::user()->is_student == 2){
         $part->teacher_id  = auth()->id();
         $question->public = 0;
        }
        $question->subjectpart_id = $part->id;
    $question->score = $request->score[$key1];
    $question->question_level = $request->question_level[$key1];
    
       if($request->video[$key1]){
               $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('video')[$key1]);

$duration =  $file['playtime_seconds'];
     $question->video_sec = $duration;
        $url = $request->video[$key1];
    // $video->size_video= $request->file('video')->getSize()/1024;
        $url->move('uploads' , time(). '.'.$url->getClientOriginalExtension());
        $question->video = time(). '.'.$url->getClientOriginalExtension();

    } 
         if($request->question_image[$key1])
    {
        $image = $request->question_image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->question_image = time().$image->getClientOriginalName();
    } 
    if( $request->image[$key1])
    {
        $image = $request->image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->image = time().$image->getClientOriginalName();
    }   
    $question->notes = $request->notes[$key1];
    $question->save();
     
    foreach($request->answer[$key1] as $key => $value){
    $questionanswer1 = new SubjectquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subjectquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
   return response()->json(['success' => 'question uploaded']);
  }public function deletesubjectquestionscenter($id){
      $part =  SubjectPart::where('id',$id)->first();
    	 /*  if(public_path() . '/uploads/' . $question->video){
         $link1 = public_path() . '/uploads/' . $question->video;
                File::delete($link1);}
    if(public_path() . '/uploads/' . $question->image){
         $link1 = public_path() . '/uploads/' . $question->image;
                File::delete($link1);}*/
    $part->delete();
    return response()->json(['status' => true]);
  }public function filtersubjectquestions(Request $request){
        if($request->years_id && $request->subjects_id){
      $questions = SubjectPart::where('admin',1)->where('subjects_id',$request->subjects_id)->get();
    }else if($request->years_id){
       $questions = SubjectPart::where('admin',1)->where('years_id',$request->years_id)->get();
    }
      $text = "";
      foreach($questions as $question){
          $text .= '<tr id="type'.$question->id.'">
                          	<td class="text-center">'.$question->id.'</td>
                      <td scope="row" class="text-center">'.$question->name.'</td>
                          <td class="text-center">';
                            if($question->subject){
                           $text .= $question->subject->name_ar;
                            }
                             $text .='</td>
                            <td class="text-center">';
                              if($question->year){
                                $text .=$question->year->year_ar;
                              }
                        $text .='</td>
                          <td class="text-center">
                            <a href="'.route('editsubjectquestionscenter',$question->id).'" > <img src="'.asset("images/pen.svg").'" id="pen" 
                           style="cursor: pointer"></a>';
                            if(auth()->user()->hasPermission("subjectquestionsscenter-delete")){
                              $text .='<img  src="'.asset("images/trash.svg").'" id="trash" onclick="deletetype('.$question->id.')" style="cursor:pointer;">';
                          }
                          $text .='        </td>
                                          </tr>';
      }
         return response()->json(['status' => true,'data' => $text]);
      
    }
}