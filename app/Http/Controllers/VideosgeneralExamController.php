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
use App\SubQuestion;
use App\SubquestionAnswer;
use App\VideosgeneralExam;
use App\VideosgeneralexamQuestion;
use App\VideosgeneralexamquestionAnswer;
class VideosgeneralExamController extends Controller
{
  public function videosgeneralexams($id){
    $video = VideosGeneral::where('id',$id)->first();
    $exams = VideosgeneralExam::where('videosgeneral_id',$id)->get();
   $questions = SubQuestion::where('public',1)->get();
    $privatequestions = SubQuestion::where('public',0)->where('user_id',$video->user_id)->get();
     return view("dashboard.videosgeneralexams.index")->with('exams',$exams)->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }
  public function addvideosgeneralexam($id){
        $video = VideosGeneral::where('id',$id)->first();
    $exams = VideosgeneralExam::where('videosgeneral_id',$id)->get();
   $questions = SubQuestion::where('public',1)->get();
    $privatequestions = SubQuestion::where('public',0)->where('user_id',$video->user_id)->get();
    return view("dashboard.videosgeneralexams.create")->with('id',$id)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function storevideosgeneralexam(Request $request,$id){
    $video = VideosGeneral::where('id',$id)->first();
   $exam = new VideosgeneralExam;
     $exam->name = $request->name_ar;
    $exam->duration_time = $request->duration_time;
    $exam->date_day = $request->date_day;
    $exam->date_time = $request->date_time;
     $exam->score = $request->totalscore;
    $exam->videosgeneral_id = $id;
     $exam->question_number = $request->question_number;
    $exam->general_id =$video->general_id;
    $exam->course_id =$video->course_id;
     $exam->sub_id =$video->sub_id;
    $exam->save();
     foreach($request->name as $key1 => $name){
    $question = new VideosgeneralexamQuestion;
    $question->general_id = $video->general_id;
    $question->sub_id = $video->sub_id;
    $question->name = $name;
    $question->videosgeneralexam_id = $exam->id;
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
    $questionanswer1 = new VideosgeneralexamquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->videosgeneralexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
        if($request->question_id){
    $questions = SubQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
       $question = new VideosgeneralexamQuestion;
    $question->general_id = $question1->general_id;
    $question->sub_id = $question1->sub_id;
    $question->name = $question1->name;
    $question->videosgeneralexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;

        $question->question_image = $question1->question_image;
  
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new VideosgeneralexamquestionAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->videosgeneralexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
        }
      return response()->json(['success' => 'exam uploaded' ,'id' => $exam->videosgeneral_id]);
  } public function editvideosgeneralexam($id){
        $exam = VideosgeneralExam::where('id',$id)->first();
     $video = VideosGeneral::where('id',$exam->videosgeneral_id)->first();
       $questions = SubQuestion::where('public',1)->get();
    $privatequestions = SubQuestion::where('public',0)->where('user_id',$video->user_id)->get();

    return view("dashboard.videosgeneralexams.edit")->with('id',$id)->with('exam',$exam)->with('questions',$questions)->with('privatequestions',$privatequestions);
  }public function updatevideosgeneralexam(Request $request,$id){
   // dd($request->all());
    //$video = VideosGeneral::where('id',$id)->first();
   $exam =  VideosgeneralExam::where('id',$id)->first();
     $exam->name = $request->name_ar;
    $exam->duration_time = $request->duration_time;
    $exam->date_day = $request->date_day;
    $exam->date_time = $request->date_time;
     $exam->score = $request->totalscore;
   // $exam->videosgeneral_id = $id;
     $exam->question_number = $request->question_number;
 //   $exam->general_id =$video->general_id;
   //  $exam->sub_id =$video->sub_id;
    $exam->save();
    if($request->name){
    VideosgeneralexamQuestion::where('videosgeneralexam_id',$id)->delete();
     foreach($request->name as $key1 => $name){
    $question = new VideosgeneralexamQuestion;
    $question->general_id = $exam->general_id;
    $question->sub_id = $exam->sub_id;
    $question->name = $name;
    $exam->course_id =$exam->course_id;
    $exam->videosgeneral_id =$exam->videosgeneral_id;
    $question->videosgeneralexam_id = $exam->id;
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
    $questionanswer1 = new VideosgeneralexamquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->videosgeneralexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
    if($request->question_id){
    $questions = SubQuestion::whereIn('id',$request->question_id)->get();
    if($questions){
    foreach($questions as $question1){
       $question = new VideosgeneralexamQuestion;
    $question->general_id = $question1->general_id;
    $question->sub_id = $question1->sub_id;
    $question->name = $question1->name;
    $question->videosgeneralexam_id = $exam->id;
    $question->score = $question1->score;
    $question->question_level = $question1->question_level;

        $question->question_image = $question1->question_image;
  
    $question->save();
    foreach($question1->answers as $answer){
    $questionanswer1 = new VideosgeneralexamquestionAnswer;
    $questionanswer1->name = $answer->name;
    $questionanswer1->correct = $answer->correct;
    $questionanswer1->videosgeneralexamquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
    }
    
      return response()->json(['success' => 'exam uploaded','id' => $exam->videosgeneral_id]);
  }public function deletevideosgeneralexam($id){
      $part =  VideosgeneralExam::where('id',$id)->first();
    	 /*  if(public_path() . '/uploads/' . $question->video){
         $link1 = public_path() . '/uploads/' . $question->video;
                File::delete($link1);}
    if(public_path() . '/uploads/' . $question->image){
         $link1 = public_path() . '/uploads/' . $question->image;
                File::delete($link1);}*/
    $part->delete();
 return response()->json(['status' => true]);
  }
}