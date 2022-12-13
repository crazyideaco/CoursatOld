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
class SpecialcollegeController extends Controller
{
  public function specialcollege(){
    
    // $sps = Specialbasic::orderBy('created_at','desc')->get();
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $sps = Specialcollege::orderBy('created_at','desc')->get();
    }else if(Auth::user() && Auth::user()->is_student == 3){
        $sps = Specialcollege::orderBy('created_at','desc')->where('doctor_id',auth()->user()->id)->where('center_id',null)->get();
    }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
         $sps = Specialcollege::orderBy('created_at','desc')->where('center_id',auth()->user()->id)->get();
    }
    return view('dashboard.specialcollege')->with('sps',$sps);
}public function addspecialcollege($id){
    $type = TypesCollege::where("id",$id)->first();
      if(auth()->user() && auth()->user()->isAdmin == 'admin'){
        $divisions = Division::all();
        $sections = Section::all();
        $subcolleges = SubjectsCollege::all();
        $typescolleges = TypesCollege::all();
        $lessons = Lesson::all();
         $users =   User::where('is_student',3)->get();
    }elseif(Auth::user() &&Auth::user()->is_student == 3){
                 $dd =   \App\Doctor_Division::where('doctor_id',Auth::user()->id)->pluck('division_id')->toArray();
                 $divisions = \App\Division::whereIn('id',$dd)->get();
                 $ds =   \App\Doctor_Section::where('doctor_id',Auth::user()->id)->pluck('section_id')->toArray();
                 $sections = \App\Section::whereIn('id',$ds)->get();
                 $dg =    \App\Doctor_Subcollege::where('doctor_id',Auth::user()->id)->pluck('subcollege_id')->toArray();
                 $subcolleges = \App\SubjectsCollege::whereIn('id',$dg)->get();
        $typescolleges = TypesCollege::where('doctor_id',auth()->user()->id)->get();
         $lessons = Lesson::where('doctor_id',auth()->user()->id)->get();
         $users = '';
    }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
        $divisions = Division::all();
        $sections = Section::all();
        $subcolleges = SubjectsCollege::all();
        $typescolleges = TypesCollege::where('center_id',Auth::user()->id)->get();
         $lessons = Lesson::where('center_id',auth()->user()->id)->get();
        $users = User::where('id',auth()->user()->id)->first()->doctors;
    }
    $videos = VideosCollege::where("user_id",$type->doctor_id)->select("name_ar","id")->get();//->take(200);
    $videos = $videos->take(700);
     return view('dashboard.addspecialcollege')
     ->with('types',Type::all())->with('users',$users)->with('colleges',College::all())
     ->with('divisions',$divisions)->
     with('sections',$sections)->with('subcolleges',$subcolleges)->with('typescolleges',$typescolleges)
     ->with('lessons',$lessons)->with('universities',University::all())->with('id',$id)->with("videos",$videos)->with("type",$type);
 }public function storespecialcollege(Request $request,$id){

       $request->validate([
        'image' => 'required|mimes:jpeg,jpg,png,gif'
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' => 'هذا الحقل يقبل صوره فقط'
             ]);
    $typescollege = TypesCollege::where("id",$id)->first();
     $sp = new Lesson;
      $sp->name_ar = $request->name_ar;
      $sp->status = 1;
    $sp->name_en = $request->name_en;
    $sp->description = $request->description;
  $sp->typescollege_id  = $id;
     if($request->hasFile('image'))
        {
        $image = $request->image;
        $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
        $sp->image = time(). '.'.$image->getClientOriginalExtension();
        }
      if(auth()->user() && auth()->user()->isAdmin == 'admin'){
          $sp->university_id = $typescollege->university_id;
          $sp->college_id = $typescollege->college_id;
          $sp->division_id = $typescollege->division_id;
          $sp->section_id = $typescollege->section_id;
          $sp->subjectscollege_id  = $typescollege->subjectscollege_id;
          $sp->doctor_id = $typescollege->doctor_id;
  

        $sp->points = $request->points;
    }elseif(Auth::user() &&Auth::user()->is_student == 3){
        $sp->university_id = auth()->user()->university_id;
          $sp->college_id = auth()->user()->college_id;
          $sp->division_id = $typescollege->division_id;
          $sp->section_id = $typescollege->section_id;
          $sp->subjectscollege_id  = $typescollege->subjectscollege_id;
          $sp->doctor_id = auth()->user()->id;
        $sp->points = $request->points;
             
    }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
         $sp->university_id = $typescollege->university_id;
          $sp->college_id = $typescollege->college_id;
          $sp->division_id = $typescollege->division_id;
          $sp->section_id = $typescollege->section_id;
          $sp->subjectscollege_id  = $typescollege->subjectscollege_id;
          $sp->doctor_id = $typescollege->doctor_id;
          $sp->center_id = auth()->user()->id;
        $sp->video_id = json_encode($videos);
        $sp->points = $request->points;
    }
    $sp->save();
     foreach($request->video_id as $key => $video_id){
         //   $videos[] = $video_id;
       $videonew =VideosCollege::where('id',$video_id)->first();
       $videonew1 = $videonew->replicate();
         $videonew1->lesson_id = $sp->id; // the new project_id
           $videonew1->video_id = $video_id;
       $videonew1->name_ar = $request->name[$key];
       $videonew1->video_size = 0;
       $videonew1->typescollege_id = $typescollege->id;
              $videonew1->paid = $request->paid[$key];
           
         $videonew1->save();
        }
        $students = $sp->typescollege->studentscollege; 
        foreach($students as $user){
          $not = new Notification;
          $text = 'لديك حصه جديده فى كورس ' . $sp->typescollege->name_ar;
      $not->title = 'اشعار جديد';
       $not->text = $text;
      $not->user_id = $user->id;
      $not->save();
      $to = $user->device_token;
           $data = [
              "to" =>$to,
              'notification'=>[
                  'title' => $not->title,
                  'body' => $not->text
                  ],
              "data" =>[
                 'title' => $not->title,
                  'body' => $not->text,
                  "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                  'type' => 'general'
                  ], 
          ];
       $dataString = json_encode($data);
          $headers = [
              'Authorization: key=AAAANEwk9ss:APA91bEuBLaq1kPuYH94OKvkO4EU_-VMrtmnj63KDB-yioNibhvl7bKbJBEQy6IvnuLyMT6AhoBi83vYe5Ds4-UaEzIyZrL9WO7ObUfTk8dIXFMih3upFFjLvPECl2ApuHe_LL2TKu6g',
              'Content-Type: application/json',
          ];
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result=curl_exec($ch);
              }
    return redirect()->route('lessons',$id);
 }public function editspecialcollege($id){
    
      if(auth()->user() && auth()->user()->isAdmin == 'admin'){
        $divisions = Division::all();
        $sections = Section::all();
        $subcolleges = SubjectsCollege::all();
        $typescolleges = TypesCollege::all();
        $lessons = Lesson::all();
         $users =   User::where('is_student',3)->get();
    }elseif(Auth::user() &&Auth::user()->is_student == 3){
                 $dd =   \App\Doctor_Division::where('doctor_id',Auth::user()->id)->pluck('division_id')->toArray();
                 $divisions = \App\Division::whereIn('id',$dd)->get();
                 $ds =   \App\Doctor_Section::where('doctor_id',Auth::user()->id)->pluck('section_id')->toArray();
                 $sections = \App\Section::whereIn('id',$ds)->get();
                 $dg =    \App\Doctor_Subcollege::where('doctor_id',Auth::user()->id)->pluck('subcollege_id')->toArray();
                 $subcolleges = \App\SubjectsCollege::whereIn('id',$dg)->get();
        $typescolleges = TypesCollege::where('doctor_id',auth()->user()->id)->get();
         $lessons = Lesson::where('doctor_id',auth()->user()->id)->get();
         $users = '';
    }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
        $divisions = Division::all();
        $sections = Section::all();
        $subcolleges = SubjectsCollege::all();
        $typescolleges = TypesCollege::where('center_id',Auth::user()->id)->get();
         $lessons = Lesson::where('center_id',auth()->user()->id)->get();
        $users = User::where('id',auth()->user()->id)->first()->doctors;
    }
      $sp =  Lesson::where('id',$id)->first();
     $type = TypesCollege::where("id",$sp->typescollege_id)->first();
      $videos = VideosCollege::where("user_id",$sp->doctor_id)->get();
     //  $videos = VideosCollege::where("typescollege_id",$sp->typescollege_id)->get();
     return view('dashboard.editspecialcollege')
     ->with('types',Type::all())->with('users',$users)->with('colleges',College::all())
     ->with('divisions',$divisions)->
     with('sections',$sections)->with('subcolleges',$subcolleges)->with('typescolleges',$typescolleges)
     ->with('lessons',$lessons)->with('universities',University::all())->with('sp',$sp)->with('videos',$videos)->with('type',$type);
 }public function updatespecialcollege(Request $request,$id){
   
   
       $request->validate([
       // 'image' => 'required|mimes:jpeg,jpg,png,gif'
         ],[
        'required' => 'هذا الحقل مطلوب' ,
        'mimes' => 'هذا الحقل يقبل صوره فقط'
             ]);
     $sp = Lesson::where('id',$id)->first();
    $typescollege = TypesCollege::where("id",$sp->typescollege_id)->first();
      $sp->name_ar = $request->name_ar;
    $sp->name_en = $request->name_en;
    $sp->description = $request->description;
     if($request->hasFile('image'))
        {
        $image = $request->image;
        $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
        $sp->image = time(). '.'.$image->getClientOriginalExtension();
        }
 if(auth()->user() && auth()->user()->isAdmin == 'admin'){
          $sp->university_id = $typescollege->university_id;
          $sp->college_id = $typescollege->college_id;
          $sp->division_id = $typescollege->division_id;
          $sp->section_id = $typescollege->section_id;
          $sp->subjectscollege_id  = $typescollege->subjectscollege_id;
          $sp->doctor_id = $typescollege->doctor_id;
  

        $sp->points = $request->points;
    }elseif(Auth::user() &&Auth::user()->is_student == 3){
        $sp->university_id = auth()->user()->university_id;
          $sp->college_id = auth()->user()->college_id;
          $sp->division_id = $typescollege->division_id;
          $sp->section_id = $typescollege->section_id;
          $sp->subjectscollege_id  = $typescollege->subjectscollege_id;
          $sp->doctor_id = auth()->user()->id;
        $sp->points = $request->points;
             
    }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
         $sp->university_id = $typescollege->university_id;
          $sp->college_id = $typescollege->college_id;
          $sp->division_id = $typescollege->division_id;
          $sp->section_id = $typescollege->section_id;
          $sp->subjectscollege_id  = $typescollege->subjectscollege_id;
          $sp->doctor_id = $typescollege->doctor_id;
          $sp->center_id = auth()->user()->id;
        $sp->video_id = json_encode($videos);
        $sp->points = $request->points;
    }
    $sp->save();
    if($request->video_id){
     $videos = VideosCollege::where("lesson_id",$sp->id)->whereNotIn('id',$request->video_id)->delete();
   //   dd($request->video_id);
    
        foreach($request->video_id as $key => $video_id){
         //   $videos[] = $video_id;
       $videonew = VideosCollege::where('id',$video_id)->first();
          
       /* if($videonew->video_id == null){
             VideosCollege::where('lesson_id',$sp->id)->delete();
        }else{
          
        }*/
       if($videonew->video_id == null){
             // Video::where('lesson_id',$sp->lesson_id)->delete();
     $videonew1 = $videonew->replicate();
         $videonew1->lesson_id = $sp->id; // the new project_id
           $videonew1->video_id = $video_id;
       $videonew1->name_ar = $request->name[$key];
         $videonew1->video_size = 0;
          $videonew1->typescollege_id = $typescollege->id;
            $videonew1->paid = $request->paid[$key];
         $videonew1->save();
    }else{
      $videonew->name_ar = $request->name[$key];
         $videonew->save();
    }
           /*$videonew1 = $videonew->replicate();
         $videonew1->lesson_id = $sp->id; // the new project_id
           $videonew1->video_id = $video_id;
       $videonew1->name_ar = $request->name[$key];
         $videonew1->video_size = 0;
           if($request->points){
              $videonew1->paid = 1;
            }else{
              $videonew1->paid = 0;
            }
         $videonew1->save();*/
   
        }
    }
return redirect('/lessons/'.$sp->typescollege_id);
 }public function deletespecialcollege($id){
    $sp = Specialcollege::where('id',$id)->first();
   $sp->delete();
   return response()->json(['status' => true]);
 }
}