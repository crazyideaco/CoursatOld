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
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:videos-create'])->only('addvideo');
        $this->middleware(['permission:videos-read'])->only('videos');
        $this->middleware(['permission:videos-update'])->only('editvideo');
        $this->middleware(['permission:videos-delete'])->only('deletevideo');
    }
    public function addvideo($id){


        $folderPath = public_path('disk4');

        $destinationDisk = 'disk4';
        $sourceDisk = 'uploads';
       $videos =  VideosCollege::where('video_type_link',0)->orderBy("id","desc")->get()->take(10);

       foreach ($videos as $video) {
           if (Storage::disk($sourceDisk)->exists($video->url)) {
               // Move the video to the destination disk
               Storage::disk($destinationDisk)->put($video->url, Storage::disk($sourceDisk)->get($video->url));

               Storage::disk($sourceDisk)->delete($video->url);
           }
       }

//            if (File::isDirectory($folderPath)) {
//                $files = File::files($folderPath);
//
//                $fileNames = [];
//
//                foreach ($files as $file) {
//                    $fileNames[] = $file->getFilename();
//                }
//            }
//                Video::whereIn("url",$fileNames)->update([
//            "video_type_link" => 4
//        ]);
//
//        VideosCollege::whereIn("url",$fileNames)->update([
//            "video_type_link" => 4
//        ]);
        if(Auth::user() && Auth::user()->isAdmin == 'admin'){
            $users =  User::where('is_student',2)->get();
            $types= Type::all();
            $years =Year::all();
            $subjects = Subject::all();
            $subtypes = Subtype::all();
        }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
            $users =  User::where('id',Auth::user()->id)->first()->teachers;
            $types= Type::where('center_id',Auth::user()->id)->get();
            $years =Year::all();
            $subjects = Subject::all();
            $subtypes = Subtype::where('center_id',auth()->user()->id)->get();
        }else if(Auth::user() && Auth::user()->is_student == 2){
            $users = "";
            $subjects = auth()->user()->subjects;
            $types= Type::where('user_id',Auth::user()->id)->where('center_id',null)->get();
            $years = auth()->user()->years;
            $subtypes = Subtype::where('user_id',auth()->user()->id)->get();
        }
        return view('dashboard.addvideo')->with('years',$years)
            ->with('subjects',$subjects)
            ->with('types',$types)->with('users',$users)->with('subtypes',$subtypes)->with('id',$id);
    }
    public function storevideo($id,Request $request){





        //dd(\Storage::disk('google')->delete("1XBtzNFUYhgGsibOxILp1FBCiZiLNzjyl"));
        //dd(\Storage::disk('google')->url($name));
        $subtype = Subtype::where('id',$id)->first();
        $validator = Validator::make($request->all(),[
            //'description_ar' => 'required',
            //'description_en' => 'required',
            //    'name_ar' => 'required',
            //  'name_en' => 'required',
            //    'board' => 'required',
            //  'image' => 'required|mimes:jpeg,jpg,png,gif',
            //  'pdf' => 'required',
            'url' => 'required'
        ],[
            'required' => 'هذا الحقل مطلوب' ,
            'mimetypes' => 'هذا الحقل يقب فيديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فقط'
        ]);
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if($validator->passes()){

            if(auth()->user() && auth()->user()->isAdmin == 'admin'){
                $video = new Video;
                $video->order_number = $request->order_number;
                $video->user_id = $subtype->user_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",$subtype->user_id)->first();
                if($paqauser==null){
                    $msg='انت غير مشترك في باقه برجاء الاشتراك في بقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg = 'انتهت صلاحيه البقه';
                    return response()->json(['status' => false,'errors' => $msg]);

                }else{
                    $videoall= Video::where('user_id',$subtype->user_id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;

                            if($request->hasFile('url'))
                            {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video= $request->file('url')->getSize()/1024;
                                //   \Storage::disk('disk4')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                //  $url->storeAs('/', time(). '.'.$url->getClientOriginalExtension(), 'uploads');

                                \Storage::disk('disk4')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                //  \Storage::disk('uploads')->putFileAs('', $url,  time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();
                                $video->video_type_link = 4;
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
                                $board->move('uploads' ,time(). $board->getClientOriginalName());
                                $video->board = time().$request->board->getClientOriginalName();
                            }
                            if($request->pay){
                                $video->paid=  $request->pay;
                            }

                            $video->save();
                            return response()->json(['success' => 'video uploaded']);

                        }else{

                            $msg =  'لقد استهلكت 100% ';

                            return response()->json(['status' => false,'errors' => $msg]);

                        }
                    }

                }

            }elseif(Auth::user() &&Auth::user()->is_student == 2){
                $video = new Video;
                $video->order_number = $request->order_number;
                $video->user_id = auth()->user()->id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
                if($paqauser==null){
                    $msg='انت غير مشترك في باقه برجاء الاشتراك في بقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg = 'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }else{
                    $videoall= Video::where('user_id',auth()->user()->id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;
                            if($request->hasFile('url'))
                            {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video= $request->file('url')->getSize()/1024;
                                \Storage::disk('disk4')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();
                                $video->video_type_link = 4;

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
                                $board->move('uploads' ,time(). $board->getClientOriginalName());
                                $video->board = time().$request->board->getClientOriginalName();
                            }
                            if($request->pay){
                                $video->paid=  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true,'success' => 'video uploaded']);

                        }else{

                            $msg =  'لقد استهلكت 100% ';

                            return response()->json(['status' => false,'errors' => $msg]);

                        }
                    }

                }
            }elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
                $video = new Video;
                $video->order_number = $request->order_number;
                $video->center_id = auth()->user()->id;
                $video->user_id = $subtype->user_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id )->first();
                if($paqauser==null){
                    $msg='انت غر مشترك في باقه بجاء الاشتراك في باقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg = 'انتهت صلاحيه البقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }else{
                    $videoall= Video::where('user_id',$request->user_id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;
                            if($request->hasFile('url'))
                            {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video= $request->file('url')->getSize()/1024;
                                \Storage::disk('disk4')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();

                                $video->video_type_link = 4;
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
                                $board->move('uploads' ,time(). $board->getClientOriginalName());
                                $video->board = time().$request->board->getClientOriginalName();
                            }
                            if($request->pay){
                                $video->paid=  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true,'success' => 'video uploaded']);

                        }else{

                            $msg =  'لقد اسهلكت 100% ';

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
    public function editvideo($id){
        $video = Video::where('id',$id)->first();

        if(Auth::user() && Auth::user()->isAdmin == 'admin'){
            $users =  User::where('is_student',2)->get();
            $types= Type::all();
            $years =Year::all();
            $subjects = Subject::all();
            $subtypes = Subtype::all();
        }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
            $users =  User::where('id',Auth::user()->id)->first()->teachers;
            $types= Type::where('center_id',Auth::user()->id)->get();
            $years =Year::all();
            $subjects = Subject::all();
            $subtypes = Subtype::where('center_id',auth()->user()->id)->get();
        }else if(Auth::user() && Auth::user()->is_student == 2){
            $users = "";
            $subjects = auth()->user()->subjects;
            $types= Type::where('user_id',Auth::user()->id)->where('center_id',null)->get();
            $years = auth()->user()->years;
            $subtypes = Subtype::where('user_id',auth()->user()->id)->get();
        }
        return view('dashboard.editvideo')->with('years',$years)
            ->with('subjects',$subjects)->with('video',$video)
            ->with('types',$types)->with('users',$users)->with('subtypes',$subtypes)->with('id',$id);
    }
    public function updatevideo($id,Request $request){

        $subtype = Subtype::where('id',$id)->first();
        $validator = Validator::make($request->all(),[
            // 'description_ar' => 'required',
            //    'description_en' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            //     'image' => 'mimes:jpeg,jpg,png,gif',
            //  'url' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ],[
            'required' => 'هذا الحقل مطوب' ,
            'mimetypes' => 'هذا الحقل يقبل فديو فقط',
            'mimes' =>  'هذا الحقل يقب صوره فقط'
        ]);

        if($validator->passes()){

            $video = Video::where('id',$id)->first();
            $video->order_number = $request->order_number;
            if(auth()->user() && auth()->user()->isAdmin == 'admin'){
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",$video->user_id)->first();
                if($paqauser==null){

                    $msg = 'انت غير مترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' =>false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){


                    $msg =  'انتهت صلاحه الباقه';
                    return response()->json(['status' =>false,'errors' => $msg]);

                }else{
                    $videoall= Video::where('user_id',$video->user_id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->description_ar = $request->description_ar;
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
                                $url->move('uploads' , time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();
                                $video->video_type_link = 4;

                            }
                            if($request->hasFile('image'))
                            { if(public_path() . '/uploads/' . $video->image){
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

                            $msg = 'لقد اتهلكت 100% ';
                            return response()->json(['status' =>'false','errors' => $msg]);
                        }
                    }

                }

            }elseif(Auth::user() &&Auth::user()->is_student == 2){

                $video->user_id = auth()->user()->id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
                if($paqauser==null){
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' =>false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' =>false,'errors' => $msg]);

                }else{
                    $videoall= Video::where('user_id',auth()->user()->id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
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
                                \Storage::disk('disk4')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();

                                $video->video_type_link = 4;
                            }
                            if($request->hasFile('image'))
                            { if(public_path() . '/uploads/' . $video->image){
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

                            $msg = 'لقد اسهلكت 100% ';
                            return response()->json(['status' =>false,'errors' => $msg]);
                        }
                    }

                }
            }elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){

                $video->center_id = auth()->user()->id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id )->first();
                if($paqauser==null){
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باه';
                    return response()->json(['status' =>false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' =>false,'errors' => $msg]);
                }else{
                    $videoall= Video::where('center_id',auth()->user()->id )->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
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
                                \Storage::disk('disk4')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();
                                $video->video_type_link = 4;

                            }
                            //image

                            if($request->hasFile('image'))
                            { if(public_path() . '/uploads/' . $video->image){
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


                            $msg = 'لقد استهكت 100% ';
                            return response()->json(['status' =>false,'errors' => $msg]);

                        }
                    }

                }
            }
        }
        else{
            $msg = $validator->messages()->first();
            return response()->json(['status' => false,'errors' => $msg]);
        }
    }public function deletevideo($id){
    $video =  Video::where('id',$id)->first();

    if( public_path() . '/uploads/' . $video->image){
        $link1 = public_path() . '/uploads/' . $video->image;
        File::delete($link1);
    }
    if($video->original == 1){
        if(public_path() . '/uploads/' . $video->url){
            $link1 = public_path() . '/uploads/' . $video->url;
            File::delete($link1);}
    }



    $video->delete();
    return response()->json(['status' => true]);
} public function videos($id){
    $subtype = Subtype::where('id',$id)->first();
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $videos =  $subtype->videos;
    }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
        $videos =  $subtype->videos->where('center_id',Auth::user()->id);
    }else if(Auth::user() && Auth::user()->is_student == 2){
        $videos =  $subtype->videos->where('user_id',Auth::user()->id);
    }
    return view('dashboard.videos')->with('videos',$videos)->with('id',$id);
}public function getvideos($id){
    if(Auth::user() && Auth::user()->isAdmin == 'admin'){
        $videos = Video::where('user_id',$id)->where('center_id',null)->get();
    }else if(Auth::user() && Auth::user()->is_student == 2){
        $videos = Video::where('user_id',auth()-user()->id)->where('center_id',null)->get();
    }else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
        $videos = Video::where('user_id',$id)->where('center_id',auth()->user()->id)->get();
    }
    $text = '';
    foreach($videos as $video){
        $text .= '<option value="'.$video->id.'">'.$video->name_ar.'</option>';
    }
    return response()->json(['data' => $text]);
}public function activevideo($id){
    $video = Video::where('id',$id)->first();
    if($video->active == 1){
        $video->active = 0;
        $video->save();
        return response(['status' => 'deactive']);
    }else if($video->active == 0){
        $video->active = 1;
        $video->save();
        return response(['status' => 'active']);
    }
}public function getvideossub($id){
    $videos = Video::where('subject_id',$id)->where('user_id',auth()->user()->id)->get();
    $text = '';
    foreach($videos as $video){
        $text .= '<option value="'.$video->id.'">'.$video->name_ar.'</option>';
    }
    return response()->json(['data' => $text]);
}public function delete_video_pdf($id){
    $video =  Video::where('id',$id)->first();
    if( public_path() . '/uploads/' . $video->pdf){
        $link1 = public_path() . '/uploads/' . $video->pdf;
        File::delete($link1);
    }
    return response(['status' => true]);
}public function delete_video_board($id){
    $video =  Video::where('id',$id)->first();
    if( public_path() . '/uploads/' . $video->board){
        $link1 = public_path() . '/uploads/' . $video->board;
        File::delete($link1);
    }
    return response(['status' => true]);
}

    public function addvideospecial($id){
        $subtype = Subtype::where("id",$id)->firstOrFail();
        if(Auth::user() && Auth::user()->isAdmin == 'admin'){
            $users =  User::where('is_student',2)->get();
            $types= Type::all();
            $years =Year::all();
            $subjects = Subject::all();
            $subtypes = Subtype::all();
        }else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 ){
            $users =  User::where('id',Auth::user()->id)->first()->teachers;
            $types= Type::where('center_id',Auth::user()->id)->get();
            $years =Year::all();
            $subjects = Subject::all();
            $subtypes = Subtype::where('center_id',auth()->user()->id)->get();
        }else if(Auth::user() && Auth::user()->is_student == 2){
            $users = "";
            $subjects = auth()->user()->subjects;
            $types= Type::where('user_id',Auth::user()->id)->where('center_id',null)->get();
            $years = auth()->user()->years;
            $subtypes = Subtype::where('user_id',auth()->user()->id)->get();
        }
        $videos = Video::where("user_id",$subtype->user_id)->select("name_ar","id")->get();
        return view('dashboard.addvideospecial')->with('years',$years)
            ->with('subjects',$subjects)
            ->with('types',$types)->with('users',$users)->with('subtypes',$subtypes)->with('id',$id)->with('videos',$videos);
    }
    public function storevideospecial($id,Request $request){



        $subtype = Subtype::where('id',$id)->first();
        $special_video = Video::where('id',$request->video_id)->first();



        if(auth()->user() && auth()->user()->isAdmin == 'admin'){
            $video = new Video;
            $video->order_number = $request->order_number;
            $video->user_id = $subtype->user_id;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;
            $video->url = $special_video->url;
            $video->seconds = $special_video->seconds;
            $video->original = 0;
            $video->subject_id = $subtype->subjects_id;
            $video->year_id = $subtype->years_id;
            $video->type_id = $subtype->type_id;
            $video->subtype_id = $subtype->id;
            $video->description_ar = $request->description_ar;
            $video->description_en = $request->description_en;

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
                $board->move('uploads' ,time(). $board->getClientOriginalName());
                $video->board = time().$request->board->getClientOriginalName();
            }
            if($request->pay){
                $video->paid=  $request->pay;
            }

            $video->save();
            return response()->json(['success' => 'video uploaded']);


        }elseif(Auth::user() &&Auth::user()->is_student == 2){
            $video = new Video;
            $video->order_number = $request->order_number;
            $video->user_id = auth()->user()->id;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;

            $video->subject_id = $subtype->subjects_id;
            $video->year_id = $subtype->years_id;
            $video->type_id = $subtype->type_id;
            $video->subtype_id = $subtype->id;
            $video->description_ar = $request->description_ar;
            $video->description_en = $request->description_en;
            $video->url = $special_video->url;
            $video->seconds = $special_video->seconds;
            $video->original = 0;
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
                $board->move('uploads' ,time(). $board->getClientOriginalName());
                $video->board = time().$request->board->getClientOriginalName();
            }
            if($request->pay){
                $video->paid=  $request->pay;
            }

            $video->save();
            return response()->json(['status' => true,'success' => 'video uploaded']);

        }elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
            $video = new Video;
            $video->order_number = $request->order_number;
            $video->center_id = auth()->user()->id;
            $video->user_id = $subtype->user_id;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;

            $video->subject_id = $subtype->subjects_id;
            $video->year_id = $subtype->years_id;
            $video->type_id = $subtype->type_id;
            $video->subtype_id = $subtype->id;
            $video->description_ar = $request->description_ar;
            $video->description_en = $request->description_en;
            $video->url = $special_video->url;
            $video->seconds = $special_video->seconds;
            $video->original = 0;
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
                $board->move('uploads' ,time(). $board->getClientOriginalName());
                $video->board = time().$request->board->getClientOriginalName();
            }
            if($request->pay){
                $video->paid=  $request->pay;
            }

            $video->save();
            return response()->json(['status' => true,'success' => 'video uploaded']);


        }

    }
}
