<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\State;
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
class VideosGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:videosgeneral-create'])->only('addvideosgeneral');
        $this->middleware(['permission:videosgeneral-read'])->only('videosgeneral');
        $this->middleware(['permission:videosgeneral-update'])->only('editvideosgeneral');
      $this->middleware(['permission:videosgeneral-delete'])->only('deletevideosgeneral');
    }
  public function addvideosgeneral($id){
    if(auth()->user() && auth()->user()->isAdmin == 'admin'){
       $subs = Sub::orderBy('created_at','Desc')->get();
        $courses = Course::all(); 
        $users = User::all(); 
       }elseif(Auth::user() &&Auth::user()->is_student == 4){
          $subs = Sub::where('general_id',auth()->user()->general_id)->get();
         $courses = Course::where('user_id',auth()->user()->id)->get();
         $users = User::all();
       }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
            $subs = Sub::orderBy('created_at','Desc')->get();
        $courses = Course::where('center_id',auth()->user()->id)->get(); 
        $users = User::where('id',auth()->user()->id)->first()->lecturers;
       }
     
     return view('dashboard.addvideosgeneral')->with('courses',$courses)->
     with('generals',General::all())->with('subs',$subs)->with('users',$users)->with('id',$id);
 }
	public function editvideosgeneral($id){
		$video = VideosGeneral::where('id',$id)->first();
    if(auth()->user() && auth()->user()->isAdmin == 'admin'){
       $subs = Sub::orderBy('created_at','Desc')->get();
        $courses = Course::all(); 
        $users = User::all(); 
       }elseif(Auth::user() &&Auth::user()->is_student == 4){
          $subs = Sub::where('general_id',auth()->user()->general_id)->get();
         $courses = Course::where('user_id',auth()->user()->id)->get();
         $users = User::all();
       }elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
            $subs = Sub::orderBy('created_at','Desc')->get();
        $courses = Course::where('center_id',auth()->user()->id)->get(); 
        $users = User::where('id',auth()->user()->id)->first()->lecturers;
       }
     
     return view('dashboard.editvideosgeneral')->with('courses',$courses)->
     with('generals',General::all())->with('subs',$subs)->with('users',$users)->with('id',$id)->with('video',$video);
 }public function deletevideosgeneral($id){
 $video =  VideosGeneral::where('id',$id)->first();
             
			    if( public_path() . '/uploads/' . $video->intro){
				 $link1 = public_path() . '/uploads/' . $video->image;
               File::delete($link1);
				}
				 if(public_path() . '/uploads/' . $video->intro){
				 $link1 = public_path() . '/uploads/' . $video->intro;
                File::delete($link1);}
		
			  
								    
     $video->delete();
  return response()->json(['status' => true]);
}
  public function storevideosgeneral($id,Request $request){
    $validator = Validator::make($request->all(),[
          //  'description_ar' => 'required',
         //   'description_en' => 'required',
              'name_ar' => 'required',
            'name_en' => 'required',
            'board' => 'required',
          'image' => 'required|mimes:jpeg,jpg,png,gif',
          //'pdf' => 'required',
            'url' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
             ],[
            'required' => 'هذا الحقل مطلوب' ,
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فقط'
                 ]);
          if($validator->fails())
     {
      return response()->json(['errors' => $validator->errors()->all()]);
     }
        if($validator->passes()){
             $course =Course::where('id',$id)->first();
         $video = new VideosGeneral;
           if(Auth::user() &&Auth::user()->is_student == 4){
         $video->general_id =$course->general_id;
     
     $video->user_id = auth()->user()->id;
      $video->name_ar = $request->name_ar;
       $video->name_en = $request->name_en;
      $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
   if($paqauser==null){
     $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
     return response()->json(['status' => false,'errors' => $msg]);
}
    elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
              $msg =  'انتهت صلاحيه الباقه';
               return response()->json(['status' => false,'errors' => $msg]);

   }else{
            $videoall= VideosGeneral::where('user_id',auth()->user()->id)->where('center_id',null)->where('created_at','>=',$paqauser->created_at)->
pluck('video_size')->toArray();
if( $videoall > 0){
          $sizepaqa=$paqauser->paqa->size;
          $sum=array_sum($videoall);
          $gigasum=$sum/1024/1024;
          if($sizepaqa >$gigasum ){
     $video->sub_id = $course->sub_id;
     $video->course_id = $course->id;
     $video->description_ar = $request->description_ar;
      $video->description_en = $request->description_en;
   if($request->hasFile('url'))
    {
       $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('url'));
    
$duration =  $file['playtime_seconds'];
     $video->seconds = $duration;
        $url = $request->url;
     $video->video_size= $request->file('url')->getSize()/1024;
        $url->move('uploads' ,time(). '.'.$url->getClientOriginalExtension());
        $video->url = time(). '.'.$url->getClientOriginalExtension();
        

    } 
    if($request->hasFile('image'))
    {
        $image = $request->image;
        $image->move('uploads' , time().$image->getClientOriginalName());
        $video->image = time().$request->image->getClientOriginalName();
    }
       if($request->hasFile('pdf'))
    {
        $pdf = $request->pdf;
        $pdf->move('uploads' , time().$pdf->getClientOriginalName());
        $video->pdf = time().$request->pdf->getClientOriginalName();
    }
       if($request->hasFile('board'))
    {
        $board = $request->board;
        $board->move('uploads' , time().$board->getClientOriginalName());
        $video->board = time().$request->board->getClientOriginalName();
    }
     if($request->pay){
     $video->paid=  $request->pay; 
    }
        $video->save();
          return response()->json(['status' => true,'success' =>'video uploaded']);
          }else{
              
      $msg = 'لقد استهلكت 100% ';
               return response()->json(['status' => false,'errors' => $msg]);

          }
   }
    
}
}else if(auth()->user() && auth()->user()->isAdmin == 'admin'){   
    $video->general_id =$course->general_id;
     
     
     $video->user_id = $course->user_id;
  $video->name_ar = $request->name_ar;
       $video->name_en = $request->name_en;
      $paqauser= Paqa_User::with("paqa")->where("user_id",$course->user_id)->first();
   if($paqauser==null){
      $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
     return response()->json(['status' => false,'errors' => $msg]);
}
    elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
              $msg =  'انتهت صلاحيه الباقه';
               return response()->json(['status' => false,'errors' => $msg]);
   }else{
           $videoall= VideosGeneral::where('user_id',$course->user_id)->where('center_id',null)->where('created_at','>=',$paqauser->created_at)->
pluck('video_size')->toArray();
if( $videoall > 0){
          $sizepaqa=$paqauser->paqa->size;
          $sum=array_sum($videoall);
          $gigasum=$sum/1024/1024;
          if($sizepaqa >$gigasum ){
     $video->sub_id = $course->sub_id;
     $video->course_id = $course->id;
     $video->description_ar = $request->description_ar;
      $video->description_en = $request->description_en;
    if($request->hasFile('url'))
    {
        $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('url'));
    
$duration =  $file['playtime_seconds'];
     $video->seconds = $duration;
        $url = $request->url;
     $video->video_size= $request->file('url')->getSize()/1024;
        $url->move('uploads' , time(). '.'.$url->getClientOriginalExtension());
        $video->url = time(). '.'.$url->getClientOriginalExtension();
        

    } 
    if($request->hasFile('image'))
    {
        $image = $request->image;
        $image->move('uploads' , time().$image->getClientOriginalName());
        $video->image = time().$request->image->getClientOriginalName();
    }
       if($request->hasFile('pdf'))
    {
        $pdf = $request->pdf;
        $pdf->move('uploads' , time().$pdf->getClientOriginalName());
        $video->pdf = time().$request->pdf->getClientOriginalName();
    }
       if($request->hasFile('board'))
    {
        $board = $request->board;
        $board->move('uploads' , time().$board->getClientOriginalName());
        $video->board = time().$request->board->getClientOriginalName();
    }
     if($request->pay){
     $video->paid=  $request->pay; 
    }
        $video->save();
    return response()->json(['status' => true,'success' =>'video uploaded']);
          }else{
              
   $msg = 'لقد استهلكت 100% ';
               return response()->json(['status' => false,'errors' => $msg]);
          }
   }
    
}}
          else if(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
         $video->general_id = $course->general_id;
     
     $video->user_id = $course->user_id;
    $video->name_ar = $request->name_ar;
       $video->name_en = $request->name_en;
     $video->center_id =  auth()->user()->id;
      $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
   if($paqauser==null){
     $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
     return response()->json(['status' => false,'errors' => $msg]);
}
    elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
              $msg =  'انتهت صلاحيه الباقه';
               return response()->json(['status' => false,'errors' => $msg]);

   }else{
        $videoall= VideosGeneral::where('center_id',auth()->user()->id)->where('created_at','>=',$paqauser->created_at)->
pluck('video_size')->toArray();
if( $videoall > 0){
          $sizepaqa=$paqauser->paqa->size;
          $sum=array_sum($videoall);
          $gigasum=$sum/1024/1024;
          if($sizepaqa >$gigasum ){
     $video->sub_id = $course->sub_id;
     $video->course_id = $course->id;
     $video->description_ar = $request->description_ar;
      $video->description_en = $request->description_en;
   if($request->hasFile('url'))
    {
       $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('url'));
    
$duration =  $file['playtime_seconds'];
     $video->seconds = $duration;
        $url = $request->url;
     $video->video_size= $request->file('url')->getSize()/1024;
        $url->move('uploads' , time(). '.'.$url->getClientOriginalExtension());
        $video->url = time(). '.'.$url->getClientOriginalExtension();
        

    } 
    if($request->hasFile('image'))
    {
        $image = $request->image;
        $image->move('uploads' , time().$image->getClientOriginalName());
        $video->image = time().$request->image->getClientOriginalName();
    }
       if($request->hasFile('pdf'))
    {
        $pdf = $request->pdf;
        $pdf->move('uploads' , time().$pdf->getClientOriginalName());
        $video->pdf = time().$request->pdf->getClientOriginalName();
    }
       if($request->hasFile('board'))
    {
        $board = $request->board;
        $board->move('uploads' , time().$board->getClientOriginalName());
        $video->board = time().$request->board->getClientOriginalName();
    }
     if($request->pay){
     $video->paid=  $request->pay; 
    }
        $video->save();
   return response()->json(['status' => true,'success' =>'video uploaded']);

          }else{
              
   $msg = 'لقد استهلكت 100% ';
               return response()->json(['status' => false,'errors' => $msg]);

          }
   }
    
}
}
 
        }else{
            $msg = $validator->messages()->first();
            return response()->json(['status' => false,'message' => $msg]);
        }
        }
	public function updatevideosgeneral($id,Request $request){
    $validator = Validator::make($request->all(),[
           // 'description_ar' => 'required',
           // 'description_en' => 'required',
             // 'name_ar' => 'required',
          //  'name_en' => 'required',
        //    'board' => 'mimes:jpeg,jpg,png,gif',
        //  'image' => 'mimes:jpeg,jpg,png,gif',
        //    'url' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
             ],[
            'required' => 'هذا الحقل مطلوب' ,
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فقط'
                 ]);
          if($validator->fails())
     {
      return response()->json(['errors' => $validator->errors()->all()]);
     }
        if($validator->passes()){
         $video = VideosGeneral::where('id',$id)->first();
           if(Auth::user() &&Auth::user()->is_student == 4){
     $video->user_id = auth()->user()->id;
      $video->name_ar = $request->name_ar;
       $video->name_en = $request->name_en;
      $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
   if($paqauser==null){
     $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
     return response()->json(['status' => false,'errors' => $msg]);
}
    elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
              $msg =  'انتهت صلاحيه الباقه';
               return response()->json(['status' => false,'errors' => $msg]);

   }else{
            $videoall= VideosGeneral::where('user_id',auth()->user()->id)->where('center_id',null)->where('created_at','>=',$paqauser->created_at)->
pluck('video_size')->toArray();
if( $videoall > 0){
          $sizepaqa=$paqauser->paqa->size;
          $sum=array_sum($videoall);
          $gigasum=$sum/1024/1024;
          if($sizepaqa >$gigasum ){
     $video->description_ar = $request->description_ar;
      $video->description_en = $request->description_en;
  if($request->hasFile('url'))
    {  
	  if(public_path() . '/uploads/' . $video->url){
         $link = public_path() . '/uploads/' . $video->url;
               File::delete($link);}
      $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('url'));
    
$duration =  $file['playtime_seconds'];
     $video->seconds = $duration;
        $url = $request->url;
     $video->size_video= $request->file('url')->getSize()/1024;
        $url->move('uploads' ,time(). '.'.$url->getClientOriginalExtension());
        $video->url =time(). '.'.$url->getClientOriginalExtension();
      

    } 
    if($request->hasFile('image'))
    {
		if(public_path() . '/uploads/' . $video->image){
          $link = public_path() . '/uploads/' . $video->image;
                 File::delete($link);}
        $image = $request->image;
        $image->move('uploads' ,time(). $image->getClientOriginalName());
        $video->image = time().$request->image->getClientOriginalName();
    }
     if($request->hasFile('pdf'))
    {
		 if(public_path() . '/uploads/' . $video->pdf){
          $link = public_path() . '/uploads/' . $video->pdf;
                File::delete($link);}
        $pdf = $request->pdf;
        $pdf->move('uploads' , time().$pdf->getClientOriginalName());
        $video->pdf = time().$request->pdf->getClientOriginalName();
    }
       if($request->hasFile('board'))
    {
		   if(public_path() . '/uploads/' . $video->board){
          $link = public_path() . '/uploads/' . $video->board;
                File::delete($link);}
        $board = $request->board;
        $board->move('uploads' ,time(). $board->getClientOriginalName());
        $video->board = time().$request->board->getClientOriginalName();
    }
     if($request->pay){
     $video->paid=  $request->pay; 
    }
        $video->save();
         return response()->json(['status' => true,'success' => 'video uploaded']);
          }else{
              
      $msg = 'لقد استهلكت 100% ';
               return response()->json(['status' => false,'message' => $msg]);

          }
   }
    
}
}else if(auth()->user() && auth()->user()->isAdmin == 'admin'){   
  $video->name_ar = $request->name_ar;
       $video->name_en = $request->name_en;
      $paqauser= Paqa_User::with("paqa")->where("user_id",$video->user_id)->first();
   if($paqauser == null){
      $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
     return response()->json(['status' => false,'errors' => $msg]);
}
    elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
              $msg =  'انتهت صلاحيه الباقه';
               return response()->json(['status' => false,'errors' => $msg]);
   }else{
           $videoall= VideosGeneral::where('user_id',$video->user_id)->where('center_id',null)->where('created_at','>=',$paqauser->created_at)->
pluck('video_size')->toArray();
if( $videoall > 0){
          $sizepaqa=$paqauser->paqa->size;
          $sum=array_sum($videoall);
          $gigasum=$sum/1024/1024;
          if($sizepaqa >$gigasum ){
     $video->description_ar = $request->description_ar;
      $video->description_en = $request->description_en;
         
  if($request->hasFile('url'))
    {  
	  if(public_path() . '/uploads/' . $video->url){
         $link = public_path() . '/uploads/' . $video->url;
               File::delete($link);}
      $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('url'));
    
$duration =  $file['playtime_seconds'];
     $video->seconds = $duration;
        $url = $request->url;
     $video->size_video= $request->file('url')->getSize()/1024;
        $url->move('uploads' ,time(). '.'.$url->getClientOriginalExtension());
        $video->url =time(). '.'.$url->getClientOriginalExtension();
      

    } 
    if($request->hasFile('image'))
    {
		if(public_path() . '/uploads/' . $video->image){
          $link = public_path() . '/uploads/' . $video->image;
                 File::delete($link);}
        $image = $request->image;
        $image->move('uploads' ,time(). $image->getClientOriginalName());
        $video->image = time().$request->image->getClientOriginalName();
    }
     if($request->hasFile('pdf'))
    {
		 if(public_path() . '/uploads/' . $video->pdf){
          $link = public_path() . '/uploads/' . $video->pdf;
                File::delete($link);}
        $pdf = $request->pdf;
        $pdf->move('uploads' , time().$pdf->getClientOriginalName());
        $video->pdf = time().$request->pdf->getClientOriginalName();
    }
       if($request->hasFile('board'))
    {
		   if(public_path() . '/uploads/' . $video->board){
          $link = public_path() . '/uploads/' . $video->board;
                File::delete($link);}
        $board = $request->board;
        $board->move('uploads' ,time(). $board->getClientOriginalName());
        $video->board = time().$request->board->getClientOriginalName();
    }
     if($request->pay){
     $video->paid=  $request->pay; 
    }
        $video->save();
         return response()->json(['status' => true,'success' => 'video uploaded']);
          }else{
              
   $msg = 'لقد استهلكت 100% ';
               return response()->json(['status' => false,'message' => $msg]);
          }
   }
    
}}
          else if(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
    $video->name_ar = $request->name_ar;
       $video->name_en = $request->name_en;
     $video->center_id =  auth()->user()->id;
      $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
   if($paqauser==null){
     $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
     return response()->json(['status' => false,'errors' => $msg]);
}
    elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
              $msg =  'انتهت صلاحيه الباقه';
               return response()->json(['status' => false,'errors' => $msg]);

   }else{
        $videoall= VideosGeneral::where('center_id',auth()->user()->id)->where('created_at','>=',$paqauser->created_at)->
pluck('video_size')->toArray();
if( $videoall > 0){
          $sizepaqa=$paqauser->paqa->size;
          $sum=array_sum($videoall);
          $gigasum=$sum/1024/1024;
          if($sizepaqa >$gigasum ){
     $video->description_ar = $request->description_ar;
      $video->description_en = $request->description_en;
     
	  if($request->hasFile('url'))
    {  
	  if(public_path() . '/uploads/' . $video->url){
         $link = public_path() . '/uploads/' . $video->url;
               File::delete($link);}
          $getID3 = new \getID3;
 $file = $getID3->analyze($request->file('url'));
    
$duration =  $file['playtime_seconds'];
     $video->seconds = $duration;
        $url = $request->url;
     $video->size_video= $request->file('url')->getSize()/1024;
        $url->move('uploads' ,time(). '.'.$url->getClientOriginalExtension());
        $video->url = time(). '.'.$url->getClientOriginalExtension();
      

    } 
    if($request->hasFile('image'))
    {
		if(public_path() . '/uploads/' . $video->image){
          $link = public_path() . '/uploads/' . $video->image;
                 File::delete($link);}
        $image = $request->image;
        $image->move('uploads' ,time(). $image->getClientOriginalName());
        $video->image = time().$request->image->getClientOriginalName();
    }
     if($request->hasFile('pdf'))
    {
		 if(public_path() . '/uploads/' . $video->pdf){
          $link = public_path() . '/uploads/' . $video->pdf;
                File::delete($link);}
        $pdf = $request->pdf;
        $pdf->move('uploads' , time().$pdf->getClientOriginalName());
        $video->pdf = time().$request->pdf->getClientOriginalName();
    }
       if($request->hasFile('board'))
    {
		   if(public_path() . '/uploads/' . $video->board){
          $link = public_path() . '/uploads/' . $video->board;
                File::delete($link);}
        $board = $request->board;
        $board->move('uploads' ,time(). $board->getClientOriginalName());
        $video->board = time().$request->board->getClientOriginalName();
    }
     if($request->pay){
     $video->paid=  $request->pay; 
    }
        $video->save();
   return response()->json(['status' => true,'success' => 'video uploaded']);

          }else{
              
   $msg = 'لقد استهلكت 100% ';
               return response()->json(['status' => false,'errors' => $msg]);

          }
   }
    
}
}
 
        }else{
            $msg = $validator->messages()->first();
            return response()->json(['status' => false,'errors' => $msg]);
        }
        }
 public function videosgeneral($id){
     $course = Course::where('id',$id)->first();
      if(Auth::user() &&Auth::user()->is_student == 4){
         $videosgeneral = $course->videos->where('user_id',auth()->user()->id)->where('center_id',null);
     } else if(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
         $videosgeneral =$course->videos->where('center_id',auth()->user()->id);
     }elseif(auth()->user() && auth()->user()->isAdmin == 'admin'){
        $videosgeneral = $course->videos;
     }
     return view('dashboard.videosgeneral')->with('videosgeneral',$videosgeneral)->with('id',$id);
 }public function activevideogeneral($id){
     $video = VideosGeneral::where('id',$id)->first();
     if($video->active == 1){
         $video->active = 0;
         $video->save();
         return response(['status' => 'deactive']);
     }else if($video->active == 0){
         $video->active = 1;
         $video->save();
         return response(['status' => 'active']);
     }
 }
}