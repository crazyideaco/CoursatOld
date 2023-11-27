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
use App\Services\VideoCollege\StorevideoscollegeService;
use App\Services\VideoCollege\UpdateVideoscollegeService;
use App\Student_Course;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;

class VideosCollegeController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware(['permission:videoscolleges-create'])->only('addvideoscollege');
        $this->middleware(['permission:videoscolleges-read'])->only('videoscolleges');
        $this->middleware(['permission:videoscolleges-update'])->only('editvideoscollege');
        $this->middleware(['permission:videoscolleges-delete'])->only('deletevideoscollege');
    }
    public function addvideoscollege($id)
    {
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::all();
            $lessons = Lesson::all();
            $users =   User::where('is_student', 3)->get();
        } elseif (Auth::user() && Auth::user()->is_student == 3) { //doctor
            $dd =   \App\Doctor_Division::where('doctor_id', Auth::user()->id)->pluck('division_id')->toArray();
            $divisions = \App\Division::whereIn('id', $dd)->get();
            $ds =   \App\Doctor_Section::where('doctor_id', Auth::user()->id)->pluck('section_id')->toArray();
            $sections = \App\Section::whereIn('id', $ds)->get();
            $dg =    \App\Doctor_Subcollege::where('doctor_id', Auth::user()->id)->pluck('subcollege_id')->toArray();
            $subcolleges = \App\SubjectsCollege::whereIn('id', $dg)->get();
            $typescolleges = TypesCollege::where('doctor_id', auth()->user()->id)->get();
            $lessons = Lesson::where('doctor_id', auth()->user()->id)->get();
            $users = '';
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) { //center
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::where('center_id', Auth::user()->id)->get();
            $lessons = Lesson::where('center_id', auth()->user()->id)->get();
            $users = User::where('id', auth()->user()->id)->first()->doctors;
            if (sizeof($users) < 0) {
                $users =   User::all();
            }
        }
        return view('dashboard.addvideoscollege')
            ->with('types', Type::all())->with('users', $users)->with('colleges', College::all())
            ->with('divisions', $divisions)->with('sections', $sections)->with('subcolleges', $subcolleges)->with('typescolleges', $typescolleges)
            ->with('lessons', $lessons)->with('universities', University::all())->with('id', $id);
    }
    /**public function storevideoscollege($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            //  'description_ar' => 'required',
            //  'description_en' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            //    'board' => 'required',
            //      'image' => 'required|mimes:jpeg,jpg,png,gif',
            //'pdf' => 'required',
            'url' => 'required'
            //  |mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فق'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($validator->passes()) {
            $lesson = Lesson::where('id', $id)->first();
            $video = new VideosCollege;
            $video->order_number = $request->order_number;
            $video->video_type_link = 7;
            if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                $video->user_id = $lesson->doctor_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $video->college_id = $lesson->college_id;
                $video->university_id = $lesson->university_id;
                //  }elseif(Auth::user() &&Auth::user()->is_student == 3){
                //         $video->user_id = auth()->user()->id;
                //   $video->college_id = auth()->user()->college_id;
                //  }
                $paqauser = Paqa_User::with("paqa")->where("user_id", $lesson->doctor_id)->first();
                if ($paqauser == null) {
                    $msg =   'انت غير مشر في باقه برجاء لاتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {

                    $videoall = VideosCollege::where('user_id', $lesson->doctor_id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {

                            $video->division_id = $lesson->division_id;
                            $video->section_id = $lesson->section_id;
                            $video->subjectscollege_id = $lesson->subjectscollege_id;
                            $video->typescollege_id = $lesson->typescollege_id;
                            $video->lesson_id = $lesson->id;
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                // $video->url = $this->upload_video($url);
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                //dd($path);
                                $video->storage_type = 1;
                                $video->video_type_link = 7;
                                // dd(\Storage::disk("google")->url($this->upload_video($url)),$this->upload_video($url));
                            }
                            if ($request->hasFile('image')) {
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid =  0;
                            }

                            $video->save();
                            $students = $lesson->typescollege->studentscollege;
                            foreach ($students as $user) {
                                $not = new Notification;
                                $text = 'لديك فيدو جديد فى كورس ' . $lesson->typescollege->name_ar;
                                $not->title = 'اشعار جيد';
                                $not->text = $text;
                                $not->user_id = $user->id;
                                $not->save();
                                $to = $user->device_token;
                                $data = [
                                    "to" => $to,
                                    'notification' => [
                                        'title' => $not->title,
                                        'body' => $not->text
                                    ],
                                    "data" => [
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
                                $result = curl_exec($ch);
                            }
                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لقد اسهكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 3) {
                $video->user_id = auth()->user()->id;
                $video->college_id = $lesson->college_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg =   'انت ر مشترك في باقه باء الاشتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('user_id', auth()->user()->id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {

                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);

                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {

                            $video->division_id = $lesson->division_id;
                            $video->section_id = $lesson->section_id;
                            $video->subjectscollege_id = $lesson->subjectscollege_id;
                            $video->typescollege_id = $lesson->typescollege_id;
                            $video->lesson_id = $lesson->id;
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->video_size = $request->file('url')->getSize() / 1024;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                            }
                            if ($request->hasFile('image')) {
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid =  0;
                            }

                            $video->save();
                            $students = $lesson->typescollege->studentscollege;
                            foreach ($students as $user) {
                                $not = new Notification;
                                $text = 'لديك فيديو جديد فى كورس ' . $lesson->typescollege->name_ar;
                                $not->title = 'اشعار جديد';
                                $not->text = $text;
                                $not->user_id = $user->id;
                                $not->save();
                                $to = $user->device_token;
                                $data = [
                                    "to" => $to,
                                    'notification' => [
                                        'title' => $not->title,
                                        'body' => $not->text
                                    ],
                                    "data" => [
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
                                $result = curl_exec($ch);
                            }
                            return response()->json(['success' => 'video uploaded']);
                        } else {


                            $msg = 'لقد استهلكت 100% ';
                            return response()->json(['status' => false, 'message' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
                $video->center_id = auth()->user()->id;
                $video->user_id = $lesson->doctor_id;
                $video->college_id = $lesson->college_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg =   'انت غير مشترك في باقه برجاء الاشتراك في باه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'اتهت لاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('center_id', auth()->user()->id)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {

                            $video->division_id = $lesson->division_id;
                            $video->section_id = $lesson->section_id;
                            $video->subjectscollege_id = $lesson->subjectscollege_id;
                            $video->typescollege_id = $lesson->typescollege_id;
                            $video->lesson_id = $lesson->id;
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->video_size = $request->file('url')->getSize() / 1024;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                            }
                            if ($request->hasFile('image')) {
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid =  0;
                            }

                            $video->save();
                            $students = $lesson->typescollege->studentscollege;
                            foreach ($students as $user) {
                                $not = new Notification;
                                $text = 'لديك فيديو جيد فى كورس ' . $lesson->typescollege->name_ar;
                                $not->title = 'اشعار جديد';
                                $not->text = $text;
                                $not->user_id = $user->id;
                                $not->save();
                                $to = $user->device_token;
                                $data = [
                                    "to" => $to,
                                    'notification' => [
                                        'title' => $not->title,
                                        'body' => $not->text
                                    ],
                                    "data" => [
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
                                $result = curl_exec($ch);
                            }
                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لق استهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            }
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => false, 'errors' => $msg]);
        }
    }*/
    public function storevideoscollege($id, Request $request)
    {
        $store_function = new StorevideoscollegeService();
        return $store_function->storevideoscollege($id, $request);
    }
    public function editvideoscollege($id)
    {
        $video = VideosCollege::where('id', $id)->first();
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::all();
            $lessons = Lesson::all();
            $users =   User::where('is_student', 3)->get();
        } elseif (Auth::user() && Auth::user()->is_student == 3) {
            $dd =   \App\Doctor_Division::where('doctor_id', Auth::user()->id)->pluck('division_id')->toArray();
            $divisions = \App\Division::whereIn('id', $dd)->get();
            $ds =   \App\Doctor_Section::where('doctor_id', Auth::user()->id)->pluck('section_id')->toArray();
            $sections = \App\Section::whereIn('id', $ds)->get();
            $dg =    \App\Doctor_Subcollege::where('doctor_id', Auth::user()->id)->pluck('subcollege_id')->toArray();
            $subcolleges = \App\SubjectsCollege::whereIn('id', $dg)->get();
            $typescolleges = TypesCollege::where('doctor_id', auth()->user()->id)->get();
            $lessons = Lesson::where('doctor_id', auth()->user()->id)->get();
            $users = '';
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::where('center_id', Auth::user()->id)->get();
            $lessons = Lesson::where('center_id', auth()->user()->id)->get();
            $users = User::where('id', auth()->user()->id)->first()->doctors;
            if (sizeof($users) < 0) {
                $users =   User::all();
            }
        }
        return view('dashboard.editvideoscollege')
            ->with('types', Type::all())->with('users', $users)->with('colleges', College::all())
            ->with('divisions', $divisions)->with('sections', $sections)->with('subcolleges', $subcolleges)->with('typescolleges', $typescolleges)
            ->with('lessons', $lessons)->with('universities', University::all())->with('video', $video);
    }
    /**public function updatevideoscollege($id, Request $request)
    {


        $subtype = Subtype::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            // 'description_ar' => 'required',
            //   'description_en' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            //     'image' => 'mimes:jpeg,jpg,png,gif',
            //     'url' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimetypes' => 'هذا الحقل يقبل يديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فق'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($validator->passes()) {
            $video = VideosCollege::where('id', $id)->first();
            $video->order_number = $request->order_number;
            if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;

                $paqauser = Paqa_User::with("paqa")->where("user_id", $video->user_id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غي مشترك في باقه براء الاتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {

                    $videoall = VideosCollege::where('user_id', $video->user_id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $this->delete_video($video);
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                $url = $request->url;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                                $video->video_type_link = 7;
                            }
                            if ($request->hasFile('image')) {
                                if (public_path() . '/uploads/' . $video->image) {
                                    $link = public_path() . '/uploads/' . $video->image;
                                    File::delete($link);
                                }
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                if (public_path() . '/uploads/' . $video->pdf) {
                                    $link = public_path() . '/uploads/' . $video->pdf;
                                    File::delete($link);
                                };
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                if (public_path() . '/uploads/' . $video->board) {
                                    $link = public_path() . '/uploads/' . $video->board;
                                    File::delete($link);
                                }
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid = 0;
                            }

                            $video->save();

                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لقد استهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 3) {
                $video->user_id = auth()->user()->id;

                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجء الاشتراك في اقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه اباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('user_id', auth()->user()->id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {

                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);

                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $this->delete_video($video);
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                $url = $request->url;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                                $video->video_type_link = 7;
                            }
                            if ($request->hasFile('image')) {
                                if (public_path() . '/uploads/' . $video->image) {
                                    $link = public_path() . '/uploads/' . $video->image;
                                    File::delete($link);
                                }
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                if (public_path() . '/uploads/' . $video->pdf) {
                                    $link = public_path() . '/uploads/' . $video->pdf;
                                    File::delete($link);
                                };
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                if (public_path() . '/uploads/' . $video->board) {
                                    $link = public_path() . '/uploads/' . $video->board;
                                    File::delete($link);
                                }
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid = 0;
                            }
                            $video->save();
                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لق اتهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {

                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'نت غير مشترك في بقه برجاء الاشترا ي باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحه لباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('center_id', auth()->user()->id)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $this->delete_video($video);
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                $url = $request->url;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                                $video->video_type_link = 7;
                            }
                            if ($request->hasFile('image')) {
                                if (public_path() . '/uploads/' . $video->image) {
                                    $link = public_path() . '/uploads/' . $video->image;
                                    File::delete($link);
                                }
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                if (public_path() . '/uploads/' . $video->pdf) {
                                    $link = public_path() . '/uploads/' . $video->pdf;
                                    File::delete($link);
                                };
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                if (public_path() . '/uploads/' . $video->board) {
                                    $link = public_path() . '/uploads/' . $video->board;
                                    File::delete($link);
                                }
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid = 0;
                            }
                            $video->save();
                            return response()->json(['success' => 'video uploaded']);
                        } else {
                            $msg = 'لقد استهلت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            }
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => false, 'message' => $msg]);
        }
    }*/
    public function updatevideoscollege($id, Request $request)
    {
        $update_function = new UpdateVideoscollegeService();
        return $update_function->updatevideoscollege($id, $request);
    }
    public function deletevideoscollege($id)
    {
        $video =  VideosCollege::where('id', $id)->first();

        if (public_path() . '/uploads/' . $video->image) {
            $link1 = public_path() . '/uploads/' . $video->image;
            File::delete($link1);
        }
        $this->delete_video($video);
        if (public_path() . '/uploads/' . $video->board) {
            $link1 = public_path() . '/uploads/' . $video->board;
            File::delete($link1);
        }
        if (public_path() . '/uploads/' . $video->pdf) {
            $link1 = public_path() . '/uploads/' . $video->pdf;
            File::delete($link1);
        }
        if ($video->original == 1) {
            if (public_path() . '/uploads/' . $video->url) {
                $link1 = public_path() . '/uploads/' . $video->url;
                File::delete($link1);
            }
        }
        $video->delete();
        return response()->json(['status' => true]);
    }
    public function videoscolleges($id)
    {
        $lesson = Lesson::where('id', $id)->firstOrFail();
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $videos =  $lesson->videos;
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $videos =  $lesson->videos; //->where('center_id',Auth::user()->id);

        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $videos =  $lesson->videos->where('center_id', null)->where('user_id', Auth::user()->id);
        }
        return view('dashboard.videoscolleges')->with('videoscolleges', $videos)->with('id', $id)->with('lesson', $lesson);
    }
    public function getvideosc($id)
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $videos = VideosCollege::where('user_id', $id)->where('center_id', null)->get();
        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $videos = VideosCollege::where('user_id', auth() - user()->id)->where('center_id', null)->get();
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $videos = VideosCollege::where('user_id', $id)->where('center_id', auth()->user()->id)->get();
        }
        $text = '';
        foreach ($videos as $video) {
            $text .= '<option value="' . $video->id . '">' . $video->name_ar . '</option>';
        }
        return response()->json(['data' => $text]);
    }
    public function getsubdocvideo($id)
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $videos =  VideosCollege::where('subjectscollege_id', $id)->get();
            $doctors = SubjectsCollege::where('id', $id)->first()->doctors;
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $videos =  VideosCollege::where('subjectscollege_id', $id)->where('center_id', auth()->user()->id)->get();
            $doctors_ids = Doctor_Subcollege::where('subcollege_id', $id)->get()
                ->pluck('doctor_id')->toArray();
            $doctors1 = User::whereIn('id', $doctors_ids)->get();
            $doctors2 = User::where('id', auth()->user()->id)->first()->doctors;
            $doctors = $doctors1->intersect($doctors2);
        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $videos =  VideosCollege::where('subjectscollege_id', $id)->where('user_id', auth()->user()->id)->get();
            $doctors = SubjectsCollege::where('id', $id)->first()->doctors;
        }
        $text = "";
        $text .= '<option value="0" selected="selected"  disabled="disabled">اختر دكتور</option>';
        foreach ($doctors as $doctor) {
            $text .= '<option value="' . $doctor->id . '">' . $doctor->name . '</option>';
        }
        $text2 = '';
        foreach ($videos as $video) {
            $text2 .= '<option value="' . $video->id . '">' . $video->name_ar . '</option>';
        }
        return response()->json(['doctor' => $text, 'video' => $text2]);
    }
    public function activevideoco($id)
    {
        $video = VideosCollege::where('id', $id)->first();
        if ($video->active == 1) {
            $video->active = 0;
            $video->save();
            return response(['status' => 'deactive']);
        } else if ($video->active == 0) {
            $video->active = 1;
            $video->save();
            return response(['status' => 'active']);
        }
    }
    public function delete_video_college_video($id)
    {
        $video =  VideosCollege::where('id', $id)->first();
        if (public_path() . '/uploads/' . $video->url) {
            $link1 = public_path() . '/uploads/' . $video->url;
            File::delete($link1);
            $video->update([
                'url' => null,
            ]);
        }
        return response(['status' => true]);
    }

    // public function delete_video_college_video($id)
    // {
    //     $video = VideosCollege::whereId($id)->first();
    //     // Check if $video is not null before trying to access its properties
    //     if ($video) {
    //         $link1 = public_path() . '/uploads/' . $video->url;

    //         // Check if the file exists before attempting to delete it
    //         if (file_exists($link1)) {
    //             File::delete($link1);
    //             return response(['status' => true, 'message' => 'Video deleted successfully.']);
    //         } else {
    //             return response(['status' => false, 'message' => 'Video file not found.']);
    //         }
    //     } else {
    //         // Handle the case where $video is null (no record found)
    //         return response(['status' => false, 'message' => 'Video not found.']);
    //     }
    // }


    public function delete_video_college_pdf($id)
    {
        $video =  VideosCollege::where('id', $id)->first();
        if (public_path() . '/uploads/' . $video->pdf) {
            $link1 = public_path() . '/uploads/' . $video->pdf;
            File::delete($link1);
        }
        return response(['status' => true]);
    }
    public function delete_video_college_board($id)
    {
        $video =  VideosCollege::where('id', $id)->first();
        if (public_path() . '/uploads/' . $video->board) {
            $link1 = public_path() . '/uploads/' . $video->board;
            File::delete($link1);
        }
        return response(['status' => true]);
    }
    public function addvideoscollegespecial($id)
    {
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::all();
            $lessons = Lesson::all();
            $users =   User::where('is_student', 3)->get();
        } elseif (Auth::user() && Auth::user()->is_student == 3) {
            $dd =   \App\Doctor_Division::where('doctor_id', Auth::user()->id)->pluck('division_id')->toArray();
            $divisions = \App\Division::whereIn('id', $dd)->get();
            $ds =   \App\Doctor_Section::where('doctor_id', Auth::user()->id)->pluck('section_id')->toArray();
            $sections = \App\Section::whereIn('id', $ds)->get();
            $dg =    \App\Doctor_Subcollege::where('doctor_id', Auth::user()->id)->pluck('subcollege_id')->toArray();
            $subcolleges = \App\SubjectsCollege::whereIn('id', $dg)->get();
            $typescolleges = TypesCollege::where('doctor_id', auth()->user()->id)->get();
            $lessons = Lesson::where('doctor_id', auth()->user()->id)->get();
            $users = '';
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::where('center_id', Auth::user()->id)->get();
            $lessons = Lesson::where('center_id', auth()->user()->id)->get();
            $users = User::where('id', auth()->user()->id)->first()->doctors;
            if (sizeof($users) < 0) {
                $users =   User::all();
            }
        }
        $lesson = Lesson::where('id', $id)->firstOrFail();

        $videos = VideosCollege::where("user_id", $lesson->doctor_id)->select("name_ar", "id")->get();
        return view('dashboard.addvideoscollegespecial')
            ->with('types', Type::all())->with('users', $users)->with('colleges', College::all())
            ->with('divisions', $divisions)->with('sections', $sections)->with('subcolleges', $subcolleges)->with('typescolleges', $typescolleges)
            ->with('lessons', $lessons)->with('universities', University::all())->with('id', $id)->with("videos", $videos);
    }
    public function storevideoscollegespecial($id, Request $request)
    {


        $special_video = VideosCollege::where("id", $request->video_id)->first();
        $lesson = Lesson::where('id', $id)->first();
        $video = new VideosCollege;
        $video->order_number = $request->order_number;
        $video->video_type_link = 7;
        $video->url = $special_video->url;
        $video->seconds = $special_video->seconds;
        $video->original = 0;
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $video->user_id = $lesson->doctor_id;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;
            $video->college_id = $lesson->college_id;
            $video->university_id = $lesson->university_id;


            $video->division_id = $lesson->division_id;
            $video->section_id = $lesson->section_id;
            $video->subjectscollege_id = $lesson->subjectscollege_id;
            $video->typescollege_id = $lesson->typescollege_id;
            $video->lesson_id = $lesson->id;
            $video->description_en = $request->description_en;
            $video->description_ar = $request->description_ar;

            if ($request->hasFile('image')) {
                $image = $request->image;
                $image->move('uploads', time() . $image->getClientOriginalName());
                $video->image = time() . $request->image->getClientOriginalName();
            }
            if ($request->hasFile('pdf')) {
                $pdf = $request->pdf;
                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
            }
            if ($request->hasFile('board')) {
                $board = $request->board;
                $board->move('uploads', time() . $board->getClientOriginalName());
                $video->board = time() . $request->board->getClientOriginalName();
            }
            if ($request->pay) {
                $video->paid =  $request->pay;
            } else {
                $video->paid =  0;
            }

            $video->video_type_link =  $special_video->video_type_link;
            $video->save();
            $students = $lesson->typescollege->studentscollege;
            foreach ($students as $user) {
                $not = new Notification;
                $text = 'لديك فيدو جديد فى كورس ' . $lesson->typescollege->name_ar;
                $not->title = 'اشعار جيد';
                $not->text = $text;
                $not->user_id = $user->id;
                $not->save();
                $to = $user->device_token;
                $data = [
                    "to" => $to,
                    'notification' => [
                        'title' => $not->title,
                        'body' => $not->text
                    ],
                    "data" => [
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
                $result = curl_exec($ch);
            }
            return response()->json(['success' => 'video uploaded']);
        } elseif (Auth::user() && Auth::user()->is_student == 3) {
            $video->user_id = auth()->user()->id;
            $video->college_id = $lesson->college_id;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;



            $video->division_id = $lesson->division_id;
            $video->section_id = $lesson->section_id;
            $video->subjectscollege_id = $lesson->subjectscollege_id;
            $video->typescollege_id = $lesson->typescollege_id;
            $video->lesson_id = $lesson->id;
            $video->description_en = $request->description_en;
            $video->description_ar = $request->description_ar;

            if ($request->hasFile('image')) {
                $image = $request->image;
                $image->move('uploads', time() . $image->getClientOriginalName());
                $video->image = time() . $request->image->getClientOriginalName();
            }
            if ($request->hasFile('pdf')) {
                $pdf = $request->pdf;
                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
            }
            if ($request->hasFile('board')) {
                $board = $request->board;
                $board->move('uploads', time() . $board->getClientOriginalName());
                $video->board = time() . $request->board->getClientOriginalName();
            }
            if ($request->pay) {
                $video->paid =  $request->pay;
            } else {
                $video->paid =  0;
            }
            $video->video_type_link =  $special_video->video_type_link;

            $video->save();
            $students = $lesson->typescollege->studentscollege;
            foreach ($students as $user) {
                $not = new Notification;
                $text = 'لديك فيديو جديد فى كورس ' . $lesson->typescollege->name_ar;
                $not->title = 'اشعار جديد';
                $not->text = $text;
                $not->user_id = $user->id;
                $not->save();
                $to = $user->device_token;
                $data = [
                    "to" => $to,
                    'notification' => [
                        'title' => $not->title,
                        'body' => $not->text
                    ],
                    "data" => [
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
                $result = curl_exec($ch);
            }
            return response()->json(['success' => 'video uploaded']);
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $video->center_id = auth()->user()->id;
            $video->user_id = $lesson->doctor_id;
            $video->college_id = $lesson->college_id;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;


            $video->division_id = $lesson->division_id;
            $video->section_id = $lesson->section_id;
            $video->subjectscollege_id = $lesson->subjectscollege_id;
            $video->typescollege_id = $lesson->typescollege_id;
            $video->lesson_id = $lesson->id;
            $video->description_en = $request->description_en;
            $video->description_ar = $request->description_ar;

            if ($request->hasFile('image')) {
                $image = $request->image;
                $image->move('uploads', time() . $image->getClientOriginalName());
                $video->image = time() . $request->image->getClientOriginalName();
            }
            if ($request->hasFile('pdf')) {
                $pdf = $request->pdf;
                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
            }
            if ($request->hasFile('board')) {
                $board = $request->board;
                $board->move('uploads', time() . $board->getClientOriginalName());
                $video->board = time() . $request->board->getClientOriginalName();
            }
            if ($request->pay) {
                $video->paid =  $request->pay;
            } else {
                $video->paid =  0;
            }
            $video->video_type_link =  $special_video->video_type_link;

            $video->save();
            $students = $lesson->typescollege->studentscollege;
            foreach ($students as $user) {
                $not = new Notification;
                $text = 'لديك فيديو جيد فى كورس ' . $lesson->typescollege->name_ar;
                $not->title = 'اشعار جديد';
                $not->text = $text;
                $not->user_id = $user->id;
                $not->save();
                $to = $user->device_token;
                $data = [
                    "to" => $to,
                    'notification' => [
                        'title' => $not->title,
                        'body' => $not->text
                    ],
                    "data" => [
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
                $result = curl_exec($ch);
            }
            return response()->json(['success' => 'video uploaded']);
        }
    }
}
