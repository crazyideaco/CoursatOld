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
use App\SubPart;
class SubQuestionController extends Controller
{
  public function addsubquestion($id){
    return view("dashboard.subquestions.create")->with('id',$id);
  }public function storesubquestion(Request $request,$id){
    $sub = Sub::where('id',$id)->first();
    $part = new SubPart;
    $part->sub_id = $sub->sub_id;
    $part->general_id = $sub->general_id;
    $part->sub_id = $id;
     $part->admin = 1;
    $part->name = $request->part;
    $part->save();
    foreach($request->name as $key1 => $name){
    $question = new SubQuestion;
    $question->general_id = $sub->general_id;
    $question->sub_id = $id;
    $question->name = $name;
      $question->subpart_id = $part->id;
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
    $questionanswer1 = new SubquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    return response()->json(['success' => 'question uploaded','id' => $id]);
  } 
  public function subquestions($id){
    $questions = SubPart::where('sub_id',$id)->where("admin",1)->get();
    return view("dashboard.subquestions.index")->with("questions",$questions)->with('id',$id);
    
  }  public function editsubquestion($id){
    $part = SubPart::where('id',$id)->first();
    return view("dashboard.subquestions.edit")->with('part',$part);
  }public function updatesubquestion(Request $request,$id){
    
    $part =  SubPart::where('id',$id)->first();
     $sub = Sub::where('id',$part->sub_id)->first();
//    $part->general_id = $sub->general_id;
  //  $part->sub_id = $id;
    $part->name = $request->part;
    $part->save();
    if($request->name){
      SubQuestion::where('subpart_id',$id)->delete();
    foreach($request->name as $key1 => $name){
    $question = new SubQuestion;
    $question->general_id = $sub->general_id;
    $question->sub_id = $sub->id;
    $question->name = $name;
      $question->subpart_id = $part->id;
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
    $questionanswer1 = new SubquestionAnswer;
    $questionanswer1->name = $value;
        if(array_key_exists($key,$request->correct[$key1])){

    $questionanswer1->correct = $request->correct[$key1][$key];
          }
    $questionanswer1->subquestion_id = $question->id;
    $questionanswer1->save();
    }
    }
    }
   return response()->json(['success' => 'question uploaded','id' => $sub->id]);
  }public function deletesubquestion($id){
      $part =  SubPart::where('id',$id)->first();
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