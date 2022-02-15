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
class SubjectQuestionController extends Controller
{
  public function addsubjectquestions($id){
    return view("dashboard.subjectsquestions.create")->with('id',$id);
  }public function storesubjectquestions(Request $request,$id){
    $subject = Subject::where('id',$id)->first();
    $part = new SubjectPart;
    $part->years_id = $subject->years_id;
    $part->subjects_id = $id;
    $part->name = $request->part;
    $part->admin =1;
    $part->save();
    foreach($request->name as $key1 => $name){
    $question = new SubjectQuestion;
    $question->years_id = $subject->years_id;
    $question->subjects_id = $id;
    $question->name = $name;
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
    return response()->json(['success' => 'question uploaded','id' => $id]);
  } 
  public function subjectquestionss($id){
    $questions = SubjectPart::where('subjects_id',$id)->where('admin',1)->get();
    return view("dashboard.subjectsquestions.index")->with("questions",$questions)->with('id',$id);
    
  }  public function editsubjectquestions($id){
    $part = SubjectPart::where('id',$id)->first();
    return view("dashboard.subjectsquestions.edit")->with('part',$part);
  }public function updatesubjectquestions(Request $request,$id){
    
    $part =  SubjectPart::where('id',$id)->first();
     $subject = Subject::where('id',$part->subjects_id)->first();
//    $part->years_id = $subject->years_id;
  //  $part->subjects_id = $id;
    $part->name = $request->part;
    $part->save();
    if($request->name){
      SubjectQuestion::where('subjectpart_id',$id)->delete();
    foreach($request->name as $key1 => $name){
    $question = new SubjectQuestion;
    $question->years_id = $subject->years_id;
    $question->subjects_id = $subject->id;
    $question->name = $name;
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
   return response()->json(['success' => 'question uploaded','id' => $subject->id]);
  }public function deletesubjectquestions($id){
      $part =  SubjectPart::where('id',$id)->first();
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