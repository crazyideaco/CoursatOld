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
use App\SubjectscollegeQuestion;
use App\SubjectscollegequestionAnswer;
use App\SubjectscollegePart;
class SubjectscollegeQuestionController extends Controller
{
  public function addsubjectscollegequestions($id){
    return view("dashboard.subjectscollegequestions.create")->with('id',$id);
  }public function storesubjectscollegequestions(Request $request,$id){
    $subject = SubjectsCollege::where('id',$id)->first();
    $part = new SubjectscollegePart;
    $part->university_id = $subject->university_id;
    $part->college_id = $subject->college_id;
    $part->division_id  = $subject->division_id ;
    $part->section_id = $subject->section_id;
    $part->subjectscollege_id  = $id;
    $part->name = $request->part;
     $part->admin = 1;
    $part->save();
    foreach($request->name as $key1 => $name){
    $question = new SubjectscollegeQuestion;
    $question->university_id = $subject->university_id;
    $question->college_id = $subject->college_id;
    $question->division_id  = $subject->division_id ;
    $question->section_id = $subject->section_id;
    $question->subjectscollege_id  = $id;
    $question->name = $name;
      $question->subjectscollegepart_id  = $part->id;
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
    $questionanswer1 = new SubjectscollegequestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subjectscollegequestion_id  = $question->id;
    $questionanswer1->save();
    }
    }
    return response()->json(['success' => 'question uploaded','id' => $id]);
  } 
  public function subjectscollegequestions($id){
    $questions = SubjectscollegePart::where('subjectscollege_id',$id)->where("admin",1)->get();
    return view("dashboard.subjectscollegequestions.index")->with("questions",$questions)->with('id',$id);
    
  }  public function editsubjectscollegequestions($id){
    $part = SubjectscollegePart::where('id',$id)->first();
    return view("dashboard.subjectscollegequestions.edit")->with('part',$part);
  }public function updatesubjectscollegequestions(Request $request,$id){
    
    $part =  SubjectscollegePart::where('id',$id)->first();
     $subject = SubjectsCollege::where('id',$part->subjectscollege_id)->first();
  //  $part->subjects_id = $id;
//   $part->university_id = $subject->university_id;
//   $part->college_id = $subject->college_id;
//   $part->division_id  = $subject->division_id ;
//   $part->section_id = $subject->section_id;
//   $part->subjectscollege_id  = $id;
  $part->name = $request->part;
  $part->save();
  if($request->name){
    SubjectscollegeQuestion::where('subjectscollegepart_id',$id)->delete();
  foreach($request->name as $key1 => $name){
  $question = new SubjectscollegeQuestion;
  $question->university_id = $subject->university_id;
  $question->college_id = $subject->college_id;
  $question->division_id  = $subject->division_id ;
  $question->section_id = $subject->section_id;
  $question->subjectscollege_id  = $subject->id;
  $question->name = $name;
    $question->subjectscollegepart_id  = $part->id;
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
  $questionanswer1 = new SubjectscollegequestionAnswer;
  $questionanswer1->name = $value;
      if(array_key_exists($key,$request->correct[$key1])){

  $questionanswer1->correct = $request->correct[$key1][$key];
        }
  $questionanswer1->subjectscollegequestion_id  = $question->id;
  $questionanswer1->save();
  }
  }
}
   return response()->json(['success' => 'question uploaded','id' => $subject->id]);
  }public function deletesubjectscollegequestions($id){
      $part =  SubjectscollegePart::where('id',$id)->first();
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