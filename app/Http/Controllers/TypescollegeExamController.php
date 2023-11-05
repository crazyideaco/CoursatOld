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
use App\SubjectscollegeQuestion;
use App\SubjectscollegequestionAnswer;
use App\TypescollegeExam;
use App\TypescollegeexamsQuestion;
use App\TypescollegeexamquestionAnswer;
use App\TypescollegeexamResult;
class TypescollegeExamController extends Controller
{
  public function typescollegeexams($id){
    $type = TypesCollege::where('id',$id)->first();
    $exams = TypescollegeExam::where('typescollege_id',$id)->get();
   $questions = SubjectscollegeQuestion::where('public',1)->where('subjectscollege_id',$type->subjectscollege_id)->get();
    $privatequestions = SubjectscollegeQuestion::where('public',0)->where('subjectscollege_id',$type->subjectscollege_id)->where('doctor_id',$type->doctor_id)->get();
     return view("dashboard.typescollegeexams.index")->with('exams',$exams)->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }
  public function addtypescollegeexam($id){
        $type = TypesCollege::where('id',$id)->first();
    $exams = TypescollegeExam::where('typescollege_id',$id)->get();
    $questions = SubjectscollegeQuestion::where('public',1)->where('subjectscollege_id',$type->subjectscollege_id)->get();
    $privatequestions = SubjectscollegeQuestion::where('public',0)->where('subjectscollege_id',$type->subjectscollege_id)->where('doctor_id',$type->doctor_id)->get();
    return view("dashboard.typescollegeexams.create")->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function storetypescollegeexam(Request $request,$id){
    $type = TypesCollege::where('id',$id)->first();
   $exam = new TypescollegeExam;
     $exam->name = $request->name_ar;
    $exam->duration_time = $request->duration_time;
    $exam->date_day = $request->date_day;
    $exam->date_time = $request->date_time;
     $exam->score = $request->totalscore;
    $exam->typescollege_id = $id;
     $exam->question_number = $request->question_number;
     $exam->university_id = $type->university_id;
      $exam->user_id = $type->doctor_id;
    $exam->college_id = $type->college_id;
    $exam->division_id  = $type->division_id ;
    $exam->section_id = $type->section_id;
    $exam->subjectscollege_id  = $type->subjectscollege_id;
    $exam->save();
     foreach($request->name as $key1 => $name){
    $question = new TypescollegeexamsQuestion;
    $question->university_id = $type->university_id;
    $question->college_id = $type->college_id;
    $question->division_id  = $type->division_id ;
    $question->section_id = $type->section_id;
    $question->subjectscollege_id  = $type->subjectscollege_id;
    $question->typescollege_id  = $type->id;
    $question->name = $name;
    $question->typescollegeexam_id = $exam->id;
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
    $questionanswer1 = new TypescollegeexamquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->typescollegeexamquestion_id  = $question->id;
    $questionanswer1->save();
    }
    }
        if($request->question_id){
    $questions = SubjectscollegeQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
       $question = new TypescollegeexamsQuestion;
       $question->university_id = $question1->university_id;
       $question->college_id = $question1->college_id;
       $question->division_id  = $question1->division_id ;
       $question->section_id = $question1->section_id;
       $question->subjectscollege_id  = $question1->subjectscollege_id;
     //  $question->typescollege_id  = $type->id;
    $question->name = $question1->name;
    $question->typescollegeexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;

        $question->question_image = $question1->question_image;
  
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new TypescollegeexamquestionAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->typescollegeexamquestion_id  = $question->id;
    $questionanswer1->save();
    }
    }
    }
        }
      return response()->json(['success' => 'exam uploaded' ,'id' => $exam->typescollege_id]);
  } public function edittypescollegeexam($id){
        $exam = TypescollegeExam::where('id',$id)->first();
     $type = TypesCollege::where('id',$exam->typescollege_id)->first();
     $questions = SubjectscollegeQuestion::where('public',1)->where('subjectscollege_id',$type->subjectscollege_id)->get();
     $privatequestions = SubjectscollegeQuestion::where('public',0)->where('subjectscollege_id',$type->subjectscollege_id)->where('doctor_id',$type->doctor_id)->get();

    return view("dashboard.typescollegeexams.edit")->with('id',$id)->with('exam',$exam)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function updatetypescollegeexam(Request $request,$id){
   // dd($request->all());
   $exam =  TypescollegeExam::where('id',$id)->first();
    $type = TypesCollege::where('id',$exam->typescollege_id)->first();
    $exam->user_id = $type->doctor_id;
   $exam->name = $request->name_ar;
   $exam->duration_time = $request->duration_time;
   $exam->date_day = $request->date_day;
   $exam->date_time = $request->date_time;
    $exam->score = $request->totalscore;
   $exam->typescollege_id = $type->id;
    $exam->question_number = $request->question_number;
    $exam->university_id = $type->university_id;
   $exam->college_id = $type->college_id;
   $exam->division_id  = $type->division_id ;
   $exam->section_id = $type->section_id;
   $exam->subjectscollege_id  = $type->subjectscollege_id;
   $exam->save();
   if($request->name){
    TypescollegeexamsQuestion::where('typescollegeexam_id',$exam->id)->delete();
    foreach($request->name as $key1 => $name){
   $question = new TypescollegeexamsQuestion;
   $question->university_id = $type->university_id;
   $question->college_id = $type->college_id;
   $question->division_id  = $type->division_id ;
   $question->section_id = $type->section_id;
   $question->subjectscollege_id  = $type->subjectscollege_id;
   $question->typescollege_id  = $type->id;
   $question->name = $name;
   $question->typescollegeexam_id = $exam->id;
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
   $questionanswer1 = new TypescollegeexamquestionAnswer;
   $questionanswer1->name = $value;
       if(array_key_exists($key,$request->correct[$key1])){

   $questionanswer1->correct = $request->correct[$key1][$key];
         }
   $questionanswer1->typescollegeexamquestion_id  = $question->id;
   $questionanswer1->save();
   }
   }
       if($request->question_id){
   $questions = SubjectscollegeQuestion::whereIn('id',$request->question_id)->get();
   if($questions){
   foreach($questions as $question1){
      $question = new TypescollegeexamsQuestion;
      $question->university_id = $question1->university_id;
      $question->college_id = $question1->college_id;
      $question->division_id  = $question1->division_id ;
      $question->section_id = $question1->section_id;
      $question->subjectscollege_id  = $question1->subjectscollege_id;
    //  $question->typescollege_id  = $type->id;
   $question->name = $question1->name;
   $question->typescollegeexam_id = $exam->id;
   $question->score = $question1->score;
   $question->question_level = $question1->question_level;

       $question->question_image = $question1->question_image;
 
   $question->save();
   foreach($question1->answers as $answer){
   $questionanswer1 = new TypescollegeexamquestionAnswer;
   $questionanswer1->name = $answer->name;
   $questionanswer1->correct = $answer->correct;
   $questionanswer1->typescollegeexamquestion_id  = $question->id;
   $questionanswer1->save();
   }
   }
   }
       }
   }
    
      return response()->json(['success' => 'exam uploaded','id' => $exam->typescollege_id]);
  }public function deletetypescollegeexam($id){
      $part =  TypescollegeExam::where('id',$id)->first();
    	 /*  if(public_path() . '/uploads/' . $question->video){
         $link1 = public_path() . '/uploads/' . $question->video;
                File::delete($link1);}
    if(public_path() . '/uploads/' . $question->image){
         $link1 = public_path() . '/uploads/' . $question->image;
                File::delete($link1);}*/
    $part->delete();
 return response()->json(['status' => true]);
  }public function typecollegeexamresults($id){
       $typeexam =  TypescollegeExam::where('id',$id)->firstOrFail();
   
    return view("dashboard.typescollegeexams.typecollegeexamresults")->with('typeexam',$typeexam);
  }public function alltypecollegeexamresults(){
       $examresults =  TypescollegeexamResult::orderBy('id',"desc")->get();
    return view("dashboard.typescollegeexams.alltypecollegeexamresults")->with('examresults',$examresults);
  }
}