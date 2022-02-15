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
class SpecialbasicController extends Controller
{
  public function addspecialbasic($id){
    $type = Type::where("id",$id)->first();
      if(Auth::user() && Auth::user()->isAdmin == 'admin'){
       $users =  User::where('is_student',2)->get();
   
       $subjects = Subject::all();
       $years = Year::all();
        $subtypes = Subtype::all();
     }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
            $users =  User::where('id',Auth::user()->id)->first()->teachers;
        
            $subjects = Subject::all();
       $years = Year::all();
        $subtypes = Subtype::where('center_id',auth()->user()->id)->get();
      }else if(Auth::user() && Auth::user()->is_student == 2){
          $users = "";
       
          $subjects = auth()->user()->subjects;
          $years = auth()->user()->years;
           $subtypes = Subtype::where('user_id',auth()->user()->id)->get();
      }
     $videos = Video::where("user_id",$type->user_id)->get();
     return view('dashboard.addspecialbasic')->with('years',$years)
     ->with('subjects',$subjects)->with("type",$type)
     ->with('users',$users)->with('subtypes',$subtypes)->with('id',$id)->with("videos",$videos);
}
public function storespecialbasic(Request $request,$id){
     $request->validate([
        'image' => 'required|mimes:jpeg,jpg,png,gif'
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' => 'هذا الحقل يقبل صوره فقط'
             ]);
  $type = Type::where("id",$id)->first();
    $sp =  new Subtype;
  $sp->status = 1;
  $sp->type_id = $id;
    $sp->name_ar = $request->name_ar;
    $sp->name_en = $request->name_en;
      if($request->hasFile('image'))
        {
        $image = $request->image;
        $image->move('uploads' ,time(). $image->getClientOriginalName());
        $sp->image = time().$request->image->getClientOriginalName();
        }
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $sp->user_id = $type->user_id;
        $sp->subjects_id = $type->subjects_id;
        $sp->years_id = $type->years_id;
      
        $sp->points = $request->points;
       
    }else if(Auth::user() && Auth::user()->is_student == 2){
        $sp->user_id = auth()->user()->id;
        $sp->subjects_id = $type->subjects_id;
        $sp->years_id = $type->years_id;

        $sp->points = $request->points;
    }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
          $sp->user_id = $type->user_id;
          $sp->center_id = auth()->user()->id;
        $sp->subjects_id = $type->subjects_id;
        $sp->years_id = $type->years_id;
       
        $sp->points = $request->points;
       
    }
   $sp->save();
           foreach($request->video_id as $key => $video_id){
       $videonew =Video::where('id',$video_id)->first();
       $videonew1 = $videonew->replicate();
         $videonew1->subtype_id = $sp->id; // the new project_id
   $videonew1->video_id = $video_id;
       $videonew1->name_ar = $request->name[$key];
         $videonew1->paid = $request->paid[$key];
         $videonew1->save();
        }
    
     return redirect('subtypes/'.$sp->type_id);
}public function editspecialbasic($id){
  $sp = Subtype::where('id',$id)->first();
      if(Auth::user() && Auth::user()->isAdmin == 'admin'){
       $users =  User::where('is_student',2)->get();
       $subjects = Subject::all();
       $years = Year::all();
        $subtypes = Subtype::all();
     }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
            $users =  User::where('id',Auth::user()->id)->first()->teachers;
            $subjects = Subject::all();
       $years = Year::all();
        $subtypes = Subtype::where('center_id',auth()->user()->id)->get();
      }else if(Auth::user() && Auth::user()->is_student == 2){
          $users = "";
          $subjects = auth()->user()->subjects;
          $years = auth()->user()->years;
           $subtypes = Subtype::where('user_id',auth()->user()->id)->get();
      }
    // $videos = Video::where("type_id",$sp->type_id)->get();
     $type = Type::where("id",$sp->type_id)->first();
     $videos = Video::where("user_id",$sp->user_id)->get();
     return view('dashboard.editspecialbasic')->with('years',$years)
     ->with('subjects',$subjects)
     ->with('type',$type)->with('users',$users)->with('subtypes',$subtypes)->with('sp',$sp)->with('videos',$videos);
}public function updatespecialbasic(Request $request,$id){
     $request->validate([
      //  'image' => 'required|mimes:jpeg,jpg,png,gif'
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' => 'هذا الحقل يقبل صوره فقط'
             ]);
   $sp = Subtype::where('id',$id)->first();
    $sp->name_ar = $request->name_ar;
    $sp->name_en = $request->name_en;
      if($request->hasFile('image'))
        {
        $image = $request->image;
        $image->move('uploads' ,time(). '.'.$image->getClientOriginalExtension());
        $sp->image = time(). '.'.$image->getClientOriginalExtension();
        }
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){

        $sp->points = $request->points;
       
    }else if(Auth::user() && Auth::user()->is_student == 2){
   
        $sp->points = $request->points;
    }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){

   
        $sp->points = $request->points;
       
    }
     $sp->save();
if($request->video_id){
     $videos = Video::where("subtype_id",$sp->id)->whereNotIn('id',$request->video_id)->delete();
   //   dd($request->video_id);
    
        foreach($request->video_id as $key => $video_id){
         //   $videos[] = $video_id;
       $videonew = Video::where('id',$video_id)->first();
          
       /* if($videonew->video_id == null){
             VideosCollege::where('lesson_id',$sp->id)->delete();
        }else{
          
        }*/
       if($videonew->video_id == null){
             // Video::where('lesson_id',$sp->lesson_id)->delete();
     $videonew1 = $videonew->replicate();
         $videonew1->subtype_id = $sp->id; // the new project_id
           $videonew1->video_id = $video_id;
       $videonew1->name_ar = $request->name[$key];
            $videonew1->paid = $request->paid[$key];
         $videonew1->save();
    }else{
      $videonew->name_ar = $request->name[$key];
         $videonew->save();
    }
        }
}
     return redirect('subtypes/'.$sp->type_id);}
public function specialbasic(){
    
    // $sps = Specialbasic::orderBy('created_at','desc')->get();
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $sps = Specialbasic::orderBy('created_at','desc')->get();
    }else if(Auth::user() && Auth::user()->is_student == 2){
        $sps = Specialbasic::orderBy('created_at','desc')->where('user_id',auth()->user()->id)->where('center_id',null)->get();
    }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
        $sps = Specialbasic::orderBy('created_at','desc')->where('center_id',auth()->user()->id)->get();
    }
    return view('dashboard.specialbasic')->with('sps',$sps);
} public function deletespecialbasic($id){
   $sp = Specialbasic::where('id',$id)->first();
   $sp->delete();
   return response()->json(['status' => true]);
 }
}