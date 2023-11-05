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
use App\TypeExam;
use App\TypeexamQuestion;
use App\TypeexamquestionsAnswer;
use App\SubtypeExam;
use App\SubtypeexamQuestion;
use App\SubtypeexamquestionsAnswer;
use App\SubtypeexamResult;
class SubtypeExamController extends Controller
{
  public function subtypeexams($id){
          $subtype = Subtype::where('id',$id)->first();
       $type = Type::where('id',$subtype->type_id)->first();
    $exams = SubtypeExam::where('subtype_id',$subtype->id)->get();
   $questions = SubjectQuestion::where('public',1)->get();
//    $privatequestions = SubjectQuestion::where('public',0)->where('teacher_id',$type->user_id)->get();
     return view("dashboard.subtypeexams.index")->with('exams',$exams)->with('id',$id);//->with('questions',$questions);//->with('privatequestions',$privatequestions);
  }
  public function addsubtypeexam($id){
        $subtype = Subtype::where('id',$id)->first();
       $type = Type::where('id',$subtype->type_id)->first();
   // $exams = TypeExam::where('type_id',$id)->get();
   $questions = SubjectQuestion::where('public',1)->where('subjects_id',$subtype->subjects_id)->get();
    $privatequestions = SubjectQuestion::where('public',0)->where('teacher_id',$type->user_id)->where('subjects_id',$subtype->subjects_id)->get();
    return view("dashboard.subtypeexams.create")->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function storesubtypeexam(Request $request,$id){

      $subtype = Subtype::where('id',$id)->first();
       $type = Type::where('id',$subtype->type_id)->first();
   $exam = new SubtypeExam;
     $exam->name = $request->name_ar;
    $exam->duration_time = $request->duration_time;
    $exam->date_day = $request->date_day;
    $exam->date_time = $request->date_time;
      $exam->subtype_id =$subtype->id;
     $exam->score = $request->totalscore;
    $exam->type_id = $type->id;
     $exam->question_number = $request->question_number;
    $exam->years_id =$type->years_id;
     $exam->subjects_id =$type->subjects_id;
    $exam->save();
     foreach($request->name as $key1 => $name){
    $question = new SubtypeexamQuestion;
    $question->years_id = $type->years_id;
    $question->subjects_id = $type->subjects_id;
    $question->name = $name;
    $question->subtypeexam_id = $exam->id;
    $question->score = $request->score[$key1];
    $question->question_level = $request->question_level[$key1];
         if($request->question_image[$key1])
    {  if(file_exists($request->question_image[$key1])){
        $image = $request->question_image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->question_image = time().$image->getClientOriginalName();
    } 
    }
    $question->save();
    foreach($request->answer[$key1] as $key => $value){
    $questionanswer1 = new SubtypeexamquestionsAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subtypeexamquestion_id  = $question->id;
    $questionanswer1->save();
    }
    }
        if($request->question_id){
    $questions = SubjectQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
       $question = new SubtypeexamQuestion;
    $question->years_id = $question1->years_id;
    $question->subjects_id = $question1->subjects_id;
    $question->name = $question1->name;
    $question->subtypeexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;

        $question->question_image = $question1->question_image;
  
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new SubtypeexamquestionsAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->subtypeexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
        }
      return response()->json(['success' => 'exam uploaded' ,'id' => $exam->subtype_id]);
  } public function editsubtypeexam($id){
       $exam = SubtypeExam::where('id',$id)->first();
     $subtype = Subtype::where('id',$exam->subtype_id)->first();
       $type = Type::where('id',$subtype->type_id)->first();

   $questions = SubjectQuestion::where('public',1)->where('subjects_id',$subtype->subjects_id)->get();
    $privatequestions = SubjectQuestion::where('public',0)->where('teacher_id',$type->user_id)->where('subjects_id',$subtype->subjects_id)->get();
    return view("dashboard.subtypeexams.edit")->with('id',$id)->with('exam',$exam)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function updatesubtypeexam(Request $request,$id){
   // dd($request->all());
    //$type = Type::where('id',$id)->first();
          $exam = SubtypeExam::where('id',$id)->first();
      $subtype = Subtype::where('id',$exam->subtype_id)->first();
       $type = Type::where('id',$subtype->type_id)->first();
     $exam->name = $request->name_ar;
    $exam->duration_time = $request->duration_time;
    $exam->date_day = $request->date_day;
    $exam->date_time = $request->date_time;
     $exam->score = $request->totalscore;
   // $exam->type_id = $id;
     $exam->question_number = $request->question_number;
 //   $exam->years_id =$type->years_id;
   //  $exam->subjects_id =$type->subjects_id;
    $exam->save();
    if($request->name){
      SubtypeexamQuestion::where('subtypeexam_id',$exam->id)->delete();
    foreach($request->name as $key1 => $name){
    $question = new SubtypeexamQuestion;
    $question->years_id = $type->years_id;
    $question->subjects_id = $type->subjects_id;
    $question->name = $name;
    $question->subtypeexam_id = $exam->id;
    $question->score = $request->score[$key1];
    $question->question_level = $request->question_level[$key1];
         if($request->question_image[$key1])
    {  if(file_exists($request->question_image[$key1])){
        $image = $request->question_image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->question_image = time().$image->getClientOriginalName();
    }
    } 
    $question->save();
    foreach($request->answer[$key1] as $key => $value){
    $questionanswer1 = new SubtypeexamquestionsAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subtypeexamquestion_id  = $question->id;
    $questionanswer1->save();
    }
    }
        if($request->question_id){
    $questions = SubjectQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
       $question = new SubtypeexamQuestion;
    $question->years_id = $question1->years_id;
    $question->subjects_id = $question1->subjects_id;
    $question->name = $question1->name;
    $question->subtypeexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;

        $question->question_image = $question1->question_image;
  
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new SubtypeexamquestionsAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->subtypeexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
        }
        }
    
      return response()->json(['success' => 'exam uploaded','id' => $exam->subtype_id]);
  }public function deletesubtypeexam($id){
              $exam = SubtypeExam::where('id',$id)->first();
    	 /*  if(public_path() . '/uploads/' . $question->video){
         $link1 = public_path() . '/uploads/' . $question->video;
                File::delete($link1);}
    if(public_path() . '/uploads/' . $question->image){
         $link1 = public_path() . '/uploads/' . $question->image;
                File::delete($link1);}*/
    $exam->delete();
 return response()->json(['status' => true]);
  }public function subtypeexamresults($id){
       $subtypeexam =  SubtypeExam::where('id',$id)->first();
   
    return view("dashboard.subtypeexams.subtypeexamresults")->with('subtypeexam',$subtypeexam);
  }public function allsubtypeexamresults(){
       $examresults =  SubtypeexamResult::orderBy('id',"desc")->get();
   
    return view("dashboard.subtypeexams.allsubtypeexamresults")->with('examresults',$examresults);
  }
}