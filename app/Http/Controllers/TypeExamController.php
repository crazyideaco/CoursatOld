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
use App\TypeexamResult;
class TypeExamController extends Controller
{
  public function typeexams($id){
    $type = Type::where('id',$id)->first();
    $exams = TypeExam::where('type_id',$id)->get();
   $questions = SubjectQuestion::where('public',1)->where("subjects_id",$type->subjects_id)->get();
    $privatequestions = SubjectQuestion::where('public',0)->where('teacher_id',$type->user_id)->where("subjects_id",$type->subjects_id)->get();
     return view("dashboard.typeexams.index")->with('exams',$exams)->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }
  public function addtypeexam($id){
    $type = Type::where('id',$id)->first();
    $exams = TypeExam::where('type_id',$id)->get();
    $questions = SubjectQuestion::where('public',1)->where("subjects_id",$type->subjects_id)->get();
    $privatequestions = SubjectQuestion::where('public',0)->where('teacher_id',$type->user_id)->where("subjects_id",$type->subjects_id)->get();
    return view("dashboard.typeexams.create")->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function storetypeexam(Request $request,$id){
   
     $type = Type::where('id',$id)->first();
     $exam = new TypeExam;
     $exam->name = $request->name_ar;
     $exam->duration_time = $request->duration_time;
     $exam->date_day = $request->date_day;
     $exam->date_time = $request->date_time;
     $exam->score = $request->totalscore;
     $exam->type_id = $id;
     $exam->question_number = $request->question_number;
     $exam->years_id =$type->years_id;
     $exam->user_id =$type->user_id;
     $exam->subjects_id =$type->subjects_id;
     $exam->save();
     foreach($request->name as $key1 => $name){
     $question = new TypeexamQuestion;
     $question->years_id = $type->years_id;
     $question->subjects_id = $type->subjects_id;
     $question->name = $name;
     $question->typeexam_id = $exam->id;
     $question->score = $request->score[$key1];
     $question->question_level = $request->question_level[$key1]; 
     if($request->question_image[$key1])
     {
            if(file_exists($request->question_image[$key1])){
        $image = $request->question_image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->question_image = time().$image->getClientOriginalName();
    }
    } 
    $question->save();
    foreach($request->answer[$key1] as $key => $value){
    $questionanswer1 = new TypeexamquestionsAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->typeexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
        if($request->question_id){
    $questions = SubjectQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
    $question = new TypeexamQuestion;
    $question->years_id = $question1->years_id;
    $question->subjects_id = $question1->subjects_id;
    $question->name = $question1->name;
    $question->typeexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;

        $question->question_image = $question1->question_image;
  
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new TypeexamquestionsAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->typeexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
    }
      return response()->json(['success' => 'exam uploaded' ,'id' => $exam->type_id]);
  } public function edittypeexam($id){
        $exam = TypeExam::where('id',$id)->first();
     $type = Type::where('id',$exam->type_id)->first();
         $questions = SubjectQuestion::where('public',1)->where("subjects_id",$type->subjects_id)->get();
    $privatequestions = SubjectQuestion::where('public',0)->where('teacher_id',$type->user_id)->where("subjects_id",$type->subjects_id)->get();

    return view("dashboard.typeexams.edit")->with('id',$id)->with('exam',$exam)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function updatetypeexam(Request $request,$id){
  
  
   $exam =  TypeExam::where('id',$id)->first();
      $type = Type::where('id',$exam->type_id)->first();
     $exam->name = $request->name_ar;
    $exam->duration_time = $request->duration_time;
    $exam->date_day = $request->date_day;
    $exam->date_time = $request->date_time;
     $exam->score = $request->totalscore;
   // $exam->type_id = $id;
     $exam->question_number = $request->question_number;
 //   $exam->years_id =$type->years_id;
   //  $exam->subjects_id =$type->subjects_id;
     $exam->user_id =$type->user_id;
    $exam->save();
    if($request->name){
    TypeexamQuestion::where('typeexam_id',$id)->delete();
     foreach($request->name as $key1 => $name){
    $question = new TypeexamQuestion;
    $question->years_id = $exam->years_id;
    $question->subjects_id = $exam->subjects_id;
    $question->name = $name;
    $question->typeexam_id = $exam->id;
    $question->score = $request->score[$key1];
    $question->question_level = $request->question_level[$key1];
         if($request->question_image[$key1])
    {
             if(file_exists($request->question_image[$key1])){
        $image = $request->question_image[$key1];
        $image->move('uploads' , time().$image->getClientOriginalName());
        $question->question_image = time().$image->getClientOriginalName();
             }else{
              $question->question_image = $request->question_image[$key1];
             }
    } 
    $question->save();
    foreach($request->answer[$key1] as $key => $value){
    $questionanswer1 = new TypeexamquestionsAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->typeexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
    if($request->question_id){
    $questions = SubjectQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
       $question = new TypeexamQuestion;
    $question->years_id = $question1->years_id;
    $question->subjects_id = $question1->subjects_id;
    $question->name = $question1->name;
    $question->typeexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;
    $question->question_image = $question1->question_image;
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new TypeexamquestionsAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->typeexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
    }
      return response()->json(['success' => 'exam uploaded','id' => $exam->type_id]);
  }public function deletetypeexam($id){
      $part =  TypeExam::where('id',$id)->first();
    	 /*  if(public_path() . '/uploads/' . $question->video){
         $link1 = public_path() . '/uploads/' . $question->video;
                File::delete($link1);}
    if(public_path() . '/uploads/' . $question->image){
         $link1 = public_path() . '/uploads/' . $question->image;
                File::delete($link1);}*/
    $part->delete();
 return response()->json(['status' => true]);
  }public function typeexamresults($id){
       $typeexam =  TypeExam::where('id',$id)->firstOrFail();
    return view("dashboard.typeexams.typeexamresults")->with('typeexam',$typeexam);
  }public function alltypeexamresults(){
    $examresults =  TypeexamResult::orderBy('id',"desc")->get();
    return view("dashboard.typeexams.alltypeexamresults")->with('examresults',$examresults);
  }
}