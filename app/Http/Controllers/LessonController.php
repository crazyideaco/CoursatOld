<?php
namespace App\Http\Controllers;

use App\College;
use App\Division;
use App\Lesson;
use App\Notification;
use App\Paqa;
use App\Paqa_User;
use App\Section;
use App\SubjectsCollege;
use App\Tag;
use App\TypesCollege;
use App\University;
use App\User;
use App\VideosCollege;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:lessons-create'])->only('addlesson');
        $this->middleware(['permission:lessons-read'])->only('lessons');
        $this->middleware(['permission:lessons-update'])->only('editlesson');
        $this->middleware(['permission:lessons-delete'])->only('deletelesson');
    }
    public function addlesson($id)
    {
        dd($id);
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::all();
            $users = User::all();
        } elseif (Auth::user() && Auth::user()->is_student == 3) {
            $dd = \App\Doctor_Division::where('doctor_id', Auth::user()->id)->pluck('division_id')->toArray();
            $divisions = \App\Division::whereIn('id', $dd)->get();
            $ds = \App\Doctor_Section::where('doctor_id', Auth::user()->id)->pluck('section_id')->toArray();
            $sections = \App\Section::whereIn('id', $ds)->get();
            $dg = \App\Doctor_Subcollege::where('doctor_id', Auth::user()->id)->pluck('subcollege_id')->toArray();
            $subcolleges = \App\SubjectsCollege::whereIn('id', $dg)->get();
            $typescolleges = TypesCollege::where('doctor_id', auth()->user()->id)->get();
            $users = '';
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::where('center_id', Auth::user()->id)->get();
            $users = User::where('id', auth()->user()->id)->first()->doctors;
        }
        $tags = Tag::all();
        return view('dashboard.addlesson')->with('colleges', College::all())->with('divisions', $divisions)->
            with('sections', $sections)->with('subcolleges', $subcolleges)->with('tags', $tags)
            ->with('typescolleges', $typescolleges)->with('users', $users)->with('universities', University::all())->with('id', $id);
    }
    public function storelesson($id, Request $request)
    {
        $type = TypesCollege::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            //    'image' => 'required|mimes:jpeg,jpg,png,gif',
            // 'intro' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            //  'url' => 'required',
            //'url.*' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            //  'images' =>'required',
//    'images.*' => 'mimes:jpeg,jpg,png,gif',
            //  'boards' => 'required',
            //'boards.*' => 'mimes:jpeg,jpg,png,gif',
            //  'pdf' => 'required'
        ], [
            'name_ar.required' => 'هذا الحقل مطلوب',
            'name_en.required' => 'هذا الحقل مطلوب',
            'mimes' => ' هذا الحقل يقبل صوره فقط',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'image.required' => 'حقل الصوره مطلوب',
            'intro.required' => 'حقل الانترو مطلوب',
        ]

        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $paqauser = Paqa_User::with("paqa")->where("user_id", $type->doctor_id)->first();
            if ($paqauser == null) {
                $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                return response()->json(['status' => false, 'errors' => $msg]);

            } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                $msg = 'انتهت صلاحيه الباقه';
                return response()->json(['status' => false, 'errors' => $msg]);

            } else {

                $videoall = VideosCollege::where('user_id', $type->doctor_id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->
                    pluck('video_size')->toArray();
                if ($videoall > 0) {
                    $sizepaqa = $paqauser->paqa->size;
                    $sum = array_sum($videoall);
                    $gigasum = $sum / 1024 / 1024;
                    if ($sizepaqa > $gigasum) {

                        $lesson = new Lesson;
                        $lesson->order_number = $request->order_number;
                        $lesson->division_id = $type->division_id;
                        $lesson->section_id = $type->section_id;
                        $lesson->subjectscollege_id = $type->subjectscollege_id;
                        $lesson->typescollege_id = $type->id;
                        $lesson->name_ar = $request->name_ar;
                        $lesson->name_en = $request->name_en;
                        $lesson->points = $request->points;
                        $lesson->part_points = $request->part_points;
                        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
                            $lesson->doctor_id = $type->doctor_id;
                            $lesson->university_id = $type->university_id;
                            $lesson->college_id = $type->college_id;
                        } else if (Auth::user() && Auth::user()->is_student == 3) {
                            $lesson->doctor_id = auth()->user()->id;
                            $lesson->college_id = $type->college_id;
                            $lesson->university_id = $type->university_id;
                        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
                            $lesson->doctor_id = $type->doctor_id;
                            $lesson->college_id = $type->college_id;
                            $lesson->center_id = auth()->user()->id;
                            $lesson->university_id = $type->university_id;
                        }
                        if ($request->hasFile('image')) {
                            $image = $request->image;
                            $file = $image->getClientOriginalName();
                            $fileName = pathinfo($file, PATHINFO_FILENAME);
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                            $lesson->image = $fileName . '_' . time() . '.' . $fileExtension;

                        }if ($request->hasFile('part_paper')) {
                            $part_paper = $request->part_paper;
                            $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                            $lesson->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
                        }
                        if ($request->hasFile('intro')) {
                            $intro = $request->intro;
                            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                            $lesson->intro = time() . '.' . $intro->getClientOriginalExtension();
                        }if ($request->hasFile('notes')) {
                            $notes = $request->notes;
                            $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                            $lesson->notes = time() . '.' . $notes->getClientOriginalExtension();
                        }

                        $lesson->save();
                        if ($request->tag_id) {
                            $lesson->tags()->attach($request->tag_id);
                        }
                        if ($request->url) {
                            foreach ($request->url as $k => $i) {
                                $video = new VideosCollege;
                                $video->user_id = $type->doctor_id;
                                $video->order_number = $request->order[$k];
                                $video->video_size = $i->getSize() / 1024;
                                $video->college_id = $lesson->college_id;
                                $video->university_id = $lesson->university_id;
                                $video->division_id = $lesson->division_id;
                                $video->section_id = $lesson->section_id;
                                $video->subjectscollege_id = $lesson->subjectscollege_id;
                                $video->typescollege_id = $lesson->typescollege_id;
                                $video->lesson_id = $lesson->id;
                                $video->name_ar = $request->names_ar[$k];
                                $video->name_en = $request->names_en[$k];
                                $video->description_en = $request->description_en[$k];
                                $video->description_ar = $request->description_ar[$k];
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($i);

                                $duration = $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $i;
                                $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();
                                //  $video->video_size= File::size($i)/1024;
                                if ($request->pay) {
                                    if (array_key_exists($k, $request->pay)) {
                                        $video->paid = $request->pay[$k];
                                    } else {
                                        $video->paid = 0;
                                    }
                                }if ($request->hasFile('images')) {
                                    $image = $request->images[$k];
                                    $image->move('uploads', time() . $image->getClientOriginalName());
                                    $video->image = time() . $request->images[$k]->getClientOriginalName();
                                }
                                if ($request->hasFile('pdf')) {
                                    $pdf = $request->pdf[$k];
                                    $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                    $video->pdf = time() . $request->pdf[$k]->getClientOriginalName();
                                }if ($request->hasFile('boards')) {
                                    $board = $request->boards[$k];
                                    $board->move('uploads', time() . $board->getClientOriginalName());
                                    $video->board = time() . $request->boards[$k]->getClientOriginalName();
                                }
                                if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                                    $video->user_id = $lesson->doctor_id;
                                } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                                    $video->user_id = $lesson->doctor_id;
                                    $video->center_id = auth()->user()->id;
                                } elseif (Auth::user() && Auth::user()->is_student == 2) {
                                    $video->user_id = auth()->user()->id;
                                }
                                $video->save();
                                $students = $lesson->typescollege->studentscollege;
                                foreach ($students as $user) {
                                    $not = new Notification;
                                    $text = 'لديك حصه جديده فى كورس ' . $lesson->typescollege->name_ar;
                                    $not->title = 'اشعار جديد';
                                    $not->text = $text;
                                    $not->user_id = $user->id;
                                    $not->save();
                                    $to = $user->device_token;
                                    $data = [
                                        "to" => $to,
                                        'notification' => [
                                            'title' => $not->title,
                                            'body' => $not->text,
                                        ],
                                        "data" => [
                                            'title' => $not->title,
                                            'body' => $not->text,
                                            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                            'type' => 'general',
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
                            }
                        }
                        return response()->json(['success' => 'video uploaded', 'id' => $lesson->typescollege_id]);} else {
                        $msg = 'لقد استهلكت 100% ';
                        return response()->json(['status' => false, 'errors' => $msg]);
                    }
                }

            }
        } elseif (Auth::user() && Auth::user()->is_student == 3) {

            $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
            if ($paqauser == null) {
                $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                return response()->json(['status' => false, 'errors' => $msg]);
            } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                $msg = 'انتهت صلاحيه الباقه';
                return response()->json(['status' => false, 'errors' => $msg]);

            } else {
                $videoall = VideosCollege::where('user_id', auth()->user()->id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->
                    pluck('video_size')->toArray();
                if ($videoall > 0) {
                    $sizepaqa = $paqauser->paqa->size;
                    $sum = array_sum($videoall);

                    $gigasum = $sum / 1024 / 1024;
                    if ($sizepaqa > $gigasum) {
                        $lesson = new Lesson;
                        $lesson->order_number = $request->order_number;
                        $lesson->division_id = $type->division_id;
                        $lesson->section_id = $type->section_id;
                        $lesson->subjectscollege_id = $type->subjectscollege_id;
                        $lesson->typescollege_id = $type->id;
                        $lesson->name_ar = $request->name_ar;
                        $lesson->name_en = $request->name_en;
                        $lesson->part_points = $request->part_points;
                        $lesson->points = $request->points;
                        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
                            $lesson->doctor_id = $type->doctor_id;
                            $lesson->university_id = $type->university_id;
                            $lesson->college_id = $type->college_id;
                        } else if (Auth::user() && Auth::user()->is_student == 3) {
                            $lesson->doctor_id = auth()->user()->id;
                            $lesson->college_id = $type->college_id;
                            $lesson->university_id = $type->university_id;
                        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
                            $lesson->doctor_id = $type->doctor_id;
                            $lesson->college_id = $type->college_id;
                            $lesson->description = $request->description;
                            $lesson->center_id = auth()->user()->id;
                            $lesson->university_id = $type->university_id;
                        }
                        if ($request->hasFile('image')) {
                            $image = $request->image;
                            $file = $image->getClientOriginalName();
                            $fileName = pathinfo($file, PATHINFO_FILENAME);
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                            $lesson->image = $fileName . '_' . time() . '.' . $fileExtension;

                        }if ($request->hasFile('part_paper')) {
                            $part_paper = $request->part_paper;
                            $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                            $lesson->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
                        }
                        if ($request->hasFile('intro')) {
                            $intro = $request->intro;
                            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                            $lesson->intro = time() . '.' . $intro->getClientOriginalExtension();
                        }if ($request->hasFile('notes')) {
                            $notes = $request->notes;
                            $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                            $lesson->notes = time() . '.' . $notes->getClientOriginalExtension();
                        }

                        $lesson->save();
                        if ($request->tag_id) {
                            $lesson->tags()->attach($request->tag_id);
                        }
                        if ($request->url) {
                            foreach ($request->url as $k => $i) {
                                $video = new VideosCollege;
                                $video->user_id = $type->doctor_id;
                                $video->order_number = $request->order[$k];
                                $video->video_size = $i->getSize() / 1024;
                                $video->college_id = $lesson->college_id;
                                $video->university_id = $lesson->university_id;
                                $video->division_id = $lesson->division_id;
                                $video->section_id = $lesson->section_id;
                                $video->subjectscollege_id = $lesson->subjectscollege_id;
                                $video->typescollege_id = $lesson->typescollege_id;
                                $video->lesson_id = $lesson->id;
                                $video->name_ar = $request->names_ar[$k];
                                $video->name_en = $request->names_en[$k];
                                $video->description_en = $request->description_en[$k];
                                $video->description_ar = $request->description_ar[$k];
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($i);

                                $duration = $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $i;
                                $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();
                                //  $video->video_size= File::size($i)/1024;
                                if ($request->pay) {
                                    if (array_key_exists($k, $request->pay)) {
                                        $video->paid = $request->pay[$k];
                                    } else {
                                        $video->paid = 0;
                                    }
                                }
                                if ($request->hasfile("images")) {
                                    $image = $request->images[$k];
                                    $image->move('uploads', time() . $image->getClientOriginalName());
                                    $video->image = time() . $request->images[$k]->getClientOriginalName();
                                }
                                if ($request->hasFile('pdf')) {
                                    $pdf = $request->pdf[$k];
                                    $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                    $video->pdf = time() . $request->pdf[$k]->getClientOriginalName();
                                }if ($request->hasfile("boards")) {
                                    $board = $request->boards[$k];
                                    $board->move('uploads', time() . $board->getClientOriginalName());
                                    $video->board = time() . $request->boards[$k]->getClientOriginalName();
                                }
                                if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                                    $video->user_id = $lesson->doctor_id;
                                } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                                    $video->user_id = $lesson->doctor_id;
                                    $video->center_id = auth()->user()->id;
                                } elseif (Auth::user() && Auth::user()->is_student == 2) {
                                    $video->user_id = auth()->user()->id;
                                }
                                $video->save();
                                $students = $lesson->typescollege->studentscollege;
                                foreach ($students as $user) {
                                    $not = new Notification;
                                    $text = 'لديك حصه جديده فى كورس ' . $lesson->typescollege->name_ar;
                                    $not->title = 'اشعار جديد';
                                    $not->text = $text;
                                    $not->user_id = $user->id;
                                    $not->save();
                                    $to = $user->device_token;
                                    $data = [
                                        "to" => $to,
                                        'notification' => [
                                            'title' => $not->title,
                                            'body' => $not->text,
                                        ],
                                        "data" => [
                                            'title' => $not->title,
                                            'body' => $not->text,
                                            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                            'type' => 'general',
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
                            }
                        }
                        return response()->json(['success' => 'video uploaded', 'id' => $lesson->typescollege_id]);} else {
                        $msg = 'لقد استهلكت 100% ';
                        return response()->json(['status' => false, 'errors' => $msg]);

                    }
                }

            }
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
            if ($paqauser == null) {
                $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                return response()->json(['status' => false, 'errors' => $msg]);
            } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                $msg = 'انتهت صلاحيه الباقه';
                return response()->json(['status' => false, 'errors' => $msg]);

            } else {
                $videoall = VideosCollege::where('center_id', auth()->user()->id)->where('created_at', '>=', $paqauser->created_at)->
                    pluck('video_size')->toArray();
                if ($videoall > 0) {
                    $sizepaqa = $paqauser->paqa->size;
                    $sum = array_sum($videoall);
                    $gigasum = $sum / 1024 / 1024;
                    if ($sizepaqa > $gigasum) {
                        $lesson = new Lesson;
                        $lesson->order_number = $request->order_number;
                        $lesson->division_id = $type->division_id;
                        $lesson->part_points = $request->part_points;
                        $lesson->section_id = $type->section_id;
                        $lesson->subjectscollege_id = $type->subjectscollege_id;
                        $lesson->typescollege_id = $type->id;
                        $lesson->name_ar = $request->name_ar;
                        $lesson->name_en = $request->name_en;
                        $lesson->points = $request->points;
                        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
                            $lesson->doctor_id = $type->doctor_id;
                            $lesson->university_id = $type->university_id;
                            $lesson->college_id = $type->college_id;
                        } else if (Auth::user() && Auth::user()->is_student == 3) {
                            $lesson->doctor_id = auth()->user()->id;
                            $lesson->college_id = $type->college_id;
                            $lesson->university_id = $type->university_id;
                        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
                            $lesson->doctor_id = $type->doctor_id;
                            $lesson->college_id = $type->college_id;
                            $lesson->center_id = auth()->user()->id;
                            $lesson->university_id = $type->university_id;
                        }
                        if ($request->hasFile('image')) {
                            $image = $request->image;
                            $file = $image->getClientOriginalName();
                            $fileName = pathinfo($file, PATHINFO_FILENAME);
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                            $lesson->image = $fileName . '_' . time() . '.' . $fileExtension;

                        }
                        if ($request->hasFile('intro')) {
                            $intro = $request->intro;
                            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                            $lesson->intro = time() . '.' . $intro->getClientOriginalExtension();
                        }if ($request->hasFile('notes')) {
                            $notes = $request->notes;
                            $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                            $lesson->notes = time() . '.' . $notes->getClientOriginalExtension();
                        }

                        $lesson->save();
                        if ($request->tag_id) {
                            $lesson->tags()->attach($request->tag_id);
                        }
                        if ($request->url) {
                            foreach ($request->url as $k => $i) {
                                $video = new VideosCollege;
                                $video->user_id = $type->doctor_id;
                                $video->order_number = $request->order[$k];
                                $video->video_size = $i->getSize() / 1024;
                                $video->college_id = $lesson->college_id;
                                $video->university_id = $lesson->university_id;
                                $video->division_id = $lesson->division_id;
                                $video->section_id = $lesson->section_id;
                                $video->subjectscollege_id = $lesson->subjectscollege_id;
                                $video->typescollege_id = $lesson->typescollege_id;
                                $video->lesson_id = $lesson->id;
                                $video->name_ar = $request->names_ar[$k];
                                $video->name_en = $request->names_en[$k];
                                $video->description_en = $request->description_en[$k];
                                $video->description_ar = $request->description_ar[$k];
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($i);

                                $duration = $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $i;
                                $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();
                                //  $video->video_size= File::size($i)/1024;
                                if ($request->pay) {
                                    if (array_key_exists($k, $request->pay)) {
                                        $video->paid = $request->pay[$k];
                                    } else {
                                        $video->paid = 0;
                                    }
                                }if ($request->hasfile("images")) {
                                    $image = $request->images[$k];
                                    $image->move('uploads', time() . $image->getClientOriginalName());
                                    $video->image = time() . $request->images[$k]->getClientOriginalName();
                                }
                                if ($request->hasFile('pdf')) {
                                    $pdf = $request->pdf[$k];
                                    $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                    $video->pdf = time() . $request->pdf[$k]->getClientOriginalName();
                                }if ($request->hasfile("boards")) {
                                    $board = $request->boards[$k];
                                    $board->move('uploads', time() . $board->getClientOriginalName());
                                    $video->board = time() . $request->boards[$k]->getClientOriginalName();
                                }
                                if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                                    $video->user_id = $lesson->doctor_id;
                                } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                                    $video->user_id = $lesson->doctor_id;
                                    $video->center_id = auth()->user()->id;
                                } elseif (Auth::user() && Auth::user()->is_student == 2) {
                                    $video->user_id = auth()->user()->id;
                                }
                                $video->save();
                                $students = $lesson->typescollege->studentscollege;
                                foreach ($students as $user) {
                                    $not = new Notification;
                                    $text = 'لديك حصه جديده فى كورس ' . $lesson->typescollege->name_ar;
                                    $not->title = 'اشعار جديد';
                                    $not->text = $text;
                                    $not->user_id = $user->id;
                                    $not->save();
                                    $to = $user->device_token;
                                    $data = [
                                        "to" => $to,
                                        'notification' => [
                                            'title' => $not->title,
                                            'body' => $not->text,
                                        ],
                                        "data" => [
                                            'title' => $not->title,
                                            'body' => $not->text,
                                            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                            'type' => 'general',
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
                            }
                        }
                        return response()->json(['success' => 'video uploaded', 'id' => $lesson->typescollege_id]);} else {
                        $msg = 'لقد استهلكت 100% ';
                        return response()->json(['status' => false, 'errors' => $msg]);

                    }
                }
            }
        }

    }
    public function lessons($id)
    {
        $type = TypesCollege::where('id', $id)->first();
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $lessons = $type->lessons;
        } elseif (Auth::user() && Auth::user()->is_student == 3) {
            $lessons = $type->lessons->where('doctor_id', auth()->user()->id)->where('center_id', null);
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $lessons = $type->lessons;//->where('center_id', auth()->user()->id);
        }
        return view('dashboard.lessons')->with('lessons', $lessons)->with('id', $id);
    }
    public function editlesson($id)
    {
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::all();
            $users = User::all();
        } elseif (Auth::user() && Auth::user()->is_student == 3) {
            $dd = \App\Doctor_Division::where('doctor_id', Auth::user()->id)->pluck('division_id')->toArray();
            $divisions = \App\Division::whereIn('id', $dd)->get();
            $ds = \App\Doctor_Section::where('doctor_id', Auth::user()->id)->pluck('section_id')->toArray();
            $sections = \App\Section::whereIn('id', $ds)->get();
            $dg = \App\Doctor_Subcollege::where('doctor_id', Auth::user()->id)->pluck('subcollege_id')->toArray();
            $subcolleges = \App\SubjectsCollege::whereIn('id', $dg)->get();
            $typescolleges = TypesCollege::where('doctor_id', auth()->user()->id)->get();
            $users = '';
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $divisions = Division::all();
            $sections = Section::all();
            $subcolleges = SubjectsCollege::all();
            $typescolleges = TypesCollege::where('center_id', Auth::user()->id)->get();
            $users = User::where('id', auth()->user()->id)->first()->doctors;
        }
        $tags = Tag::all();
        return view('dashboard.editlesson')->with('colleges', College::all())->with('divisions', $divisions)->
            with('sections', $sections)->with('subcolleges', $subcolleges)
            ->with('typescolleges', $typescolleges)->with('users', $users)->
            with('lesson', Lesson::where('id', $id)->first())->with('universities', University::all())->with('tags', $tags);
    }
    public function updatelesson($id, Request $request)
    {
        $request->validate([
            //   'image' => 'mimes:jpeg,jpg,png,gif',
            //    'intro' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'mimes' => 'هذا الحقل يقبل صوره فقط',
        ]);
        $lesson = Lesson::where('id', $id)->first();
        $lesson->order_number = $request->order_number;
        $lesson->part_points = $request->part_points;
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {

        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $lesson->doctor_id = auth()->user()->id;
            $lesson->university_id = auth()->user()->university_id;
            $lesson->college_id = auth()->user()->college_id;
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $lesson->doctor_id = $request->doctor_id;

            $lesson->center_id = auth()->user()->id;
        }
        $lesson->name_ar = $request->name_ar;
        $lesson->name_en = $request->name_en;
        $lesson->description = $request->description;
        $lesson->points = $request->points;
        if ($request->hasFile('image')) {
            if (public_path() . '/uploads/' . $lesson->image) {
                $link1 = public_path() . '/uploads/' . $lesson->image;
                File::delete($link1);}
            $image = $request->image;

            $file = $image->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
            $lesson->image = $fileName . '_' . time() . '.' . $fileExtension;

        }if ($request->hasFile('part_paper')) {
            if (public_path() . '/uploads/' . $lesson->part_paper) {
                $link1 = public_path() . '/uploads/' . $lesson->part_paper;
                File::delete($link1);}
            $part_paper = $request->part_paper;
            $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
            $lesson->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
        }
        if ($request->hasFile('intro')) {
            if (public_path() . '/uploads/' . $lesson->intro) {
                $link1 = public_path() . '/uploads/' . $lesson->intro;
                File::delete($link1);}
            $intro = $request->intro;
            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
            $lesson->intro = time() . '.' . $intro->getClientOriginalExtension();
        }
        if ($request->hasFile('notes')) {if (public_path() . '/uploads/' . $lesson->notes) {
            $link1 = public_path() . '/uploads/' . $lesson->notes;
            File::delete($link1);}
            $notes = $request->notes;
            $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
            $lesson->notes = time() . '.' . $notes->getClientOriginalExtension();
        }
        $lesson->save();
        if ($request->tag_id) {
            $lesson->tags()->sync($request->tag_id);
        }
        return response()->json(['success' => 'video uploaded', 'id' => $lesson->typescollege_id]);
        //     return redirect('/lessons/'.$lesson->typescollege_id);
    }public function deletelesson($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        if ($lesson->status == 0) {
            if (public_path() . '/uploads/' . $lesson->image) {
                $link1 = public_path() . '/uploads/' . $lesson->image;
                File::delete($link1);}if (public_path() . '/uploads/' . $lesson->intro) {
                $link1 = public_path() . '/uploads/' . $lesson->intro;
                File::delete($link1);}
            if ($lesson->videos) {
                foreach ($lesson->videos as $video) {
                    if (public_path() . '/uploads/' . $video->url) {
                        $link = public_path() . '/uploads/' . $video->url;
                        File::delete($link);}
                }
            }
        } else {

        }

        $lesson->delete();
        return response()->json(['status' => true]);
    }public function getlesson($id)
    {
        if (Auth::user() && Auth::user()->is_student == 5 &&
            Auth::user()->category_id == 2) {
            $doctor = TypesCollege::where('id', $id)->first()->doctor;
            $lessons = Lesson::where('typescollege_id', $id)->
                where('center_id', auth()->user()->id)->get();
        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $lessons = Lesson::where('typescollege_id', $id)->where('doctor_id', auth()->user()->id)->get();
            $doctor = TypesCollege::where('id', $id)->first()->doctor;
        } else {
            $doctor = TypesCollege::where('id', $id)->first()->doctor;
            $lessons = Lesson::where('typescollege_id', $id)->get();

        }
        $text2 = '';
        $text2 .= '<option value="' . $doctor->id . '" selected="selected">' . $doctor->name . '</option>';
        $text = "";
        $text .= '<option value="0" selected="selected" disabled="disabled">اختار الحصه</option>';
        foreach ($lessons as $lesson) {
            $text .= '<option value="' . $lesson->id . '">' . $lesson->name_ar . '</option>';
        }

        return response()->json(['lesson' => $text, 'doctor' => $text2]);
    }public function activelesson($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        if ($lesson->active == 1) {
            $lesson->active = 0;
            $lesson->save();
            return response(['status' => 'deactive']);
        } else if ($lesson->active == 0) {
            $lesson->active = 1;
            $lesson->save();
            return response(['status' => 'active']);
        }
    }public function lessonattendstudents($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        return view('dashboard.attendstudents.lessonattendstudents')->with('lesson', $lesson);
    }
}
